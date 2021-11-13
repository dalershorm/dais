<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Direction;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $order = Order::with('status', 'user');
        $order->where('employer_id', auth()->user()->id);

        return response()->json([
            'orders' => $order->orderBy('id', 'desc')->get()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderRequest $request)
    {
        if (auth()->user()->balance < $request->cost_china) {
            return response()->json([
                'message' => 'У вас не достаточний средств'
            ], 403);
        }
        $order = Order::create($request->all() + ['employer_id'=> auth()->user()->id]);

        User::find($order->employer_id)->update([
            'balance' => auth()->user()->balance - (int)$request->cost_china
        ]);

        $order->balance_histories()->sync([
            auth()->user()->id => [
                'cost_china' => $request->cost_china,
            ]
        ]);

        return response()->json([
            'message' => 'Данные успешно добавлени'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        // if ($this->checkAccess($order)){
        //     return response()->json([

        //     ], 403);
        // } Просмотреть во надо сделать так чтоб во всех статусах можно было смотерть
        return response()->json([
            'order' => $order->load('user', 'direction', 'shipping', 'status'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OrderRequest $request, Order $order)
    {
        if ($this->checkAccess($order)){
            return response()->json([

            ], 403);
        }
        $order->update($request->all());

        return response()->json([
            'message' => 'Данные успешно обновлени'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order)
    {
        if ($this->checkAccess($order)){
            return response()->json([

            ], 403);
        }
        $order->delete();
        return response()->json([
            'message' => 'Запись удаленно'
        ]);
    }

    private function checkAccess($order) {
        if (in_array($order->status_id, [
            Order::STATUS_PACKING,
            Order::STATUS_SEND,
            Order::STATUS_RECEPTION_DUSHANBE,
            Order::STATUS_REST,
            Order::STATUS_PAY,
        ]) || $order->employer_id !== auth()->user()->id) {
            return true;
        }

        return false;
    }
}
