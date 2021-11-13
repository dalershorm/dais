<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\DeliveryRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(ProfileRequest $request) {
        $user = User::find(auth()->user()->id);
        $user->update($request->validated());

        return response()->json([
            'user' => User::with('direction')->find($user->id),
            'message' => 'Данные успешно обновлени'
        ]);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if (Hash::check($request->current_password, auth()->user()->password)) {
            User::find(auth()->user()->id)->update(['password' => $request->password]);
            return response()->json([
                'message' => 'Ваш пароль успешно обновлен'
            ]);
        }
        return response()->json([
            'message' => 'Текущий пароль введен неверно'
        ], 403);
    }

    public function changeAvatar(Request $request) {
        User::find(auth()->user()->id)->update(['avatar' => $request->avatar]);

        return response()->json([
            'message' => 'Аватар успешно обновлен'
        ]);
    }

    public function getOrders() {

        return response()->json([
            'orders' => Order::with('user:id,name,client_code', 'status:id,name', 'direction:id,name')
                ->where('user_id', auth()->user()->id)
                ->get()
        ]);
    }

    public function getPayOrders() {

        return response()->json([
            'orders' => Order::with('user:id,name,client_code', 'status:id,name', 'direction:id,name')
                ->where('user_id', auth()->user()->id)
                ->where('status_id', Order::STATUS_PAY)
                ->get()
        ]);
    }

    public function findOrder(Request $request) {

        return response()->json([
            'orders' => Order::with('status:id,name', 'user:id,client_code', 'direction:id,name', 'shipping:id,name')->where('track_code', $request->track_code)->where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function deliveryOrders(DeliveryRequest $request)
    {
        $delivery = Delivery::create($request->all() + [
                'user_id'   => auth()->user()->id,
                'status_id' => Delivery::STATUS_CREATED
            ]);

        $orders = Order::whereIn('id', $request->orders)->pluck('id');

        $delivery->delivery_orders()->sync($orders);

        return response()->json([
            'message' => 'Ваша заявка принята'
        ]);
    }

    public function getDeliveries(Request $request) {

        return response()->json([
            'deliveries' => Delivery::with('delivery_orders', 'status')->where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function getStatistic() {
        $ordersCount = Order::whereIn('status_id', [
            Order::STATUS_RECEPTION_ORDER,
            Order::STATUS_SEND,
            Order::STATUS_RECEPTION_DUSHANBE
        ])->where('user_id', auth()->user()->id)->count();

        $reception_orders   = Order::where('status_id', Order::STATUS_RECEPTION_ORDER)->where('user_id', auth()->user()->id)->count();
        $reception_dushanbe = Order::where('status_id', Order::STATUS_RECEPTION_DUSHANBE)->where('user_id', auth()->user()->id)->count();
        $send_orders        = Order::where('status_id', Order::STATUS_SEND)->where('user_id', auth()->user()->id)->count();

        return response()->json([
            'reception_orders_percent'   => $reception_orders && $ordersCount ? round($reception_orders * 100 / $ordersCount, 2) : 0,
            'reception_dushanbe_percent' => $reception_dushanbe && $ordersCount ? round($reception_dushanbe * 100 / $ordersCount, 2) : 0,
            'send_orders_percent'        => $send_orders && $ordersCount ? round($send_orders * 100 / $ordersCount, 2) : 0,

            'reception_orders'   => $reception_orders,
            'reception_dushanbe' => $reception_dushanbe,
            'send_orders'        => $send_orders,
            
            'ordersCount'        => $ordersCount
        ]);
    }

    public function getOrderPrice($id)
    {
        $price = Order::find($id);
        if ($price) {
            return response()->json([
                'price' => $price->cost + $price->cost_china  
            ]);
        }
        abort(403);
    }
}
