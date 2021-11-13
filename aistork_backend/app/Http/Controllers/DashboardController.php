<?php

namespace App\Http\Controllers;

use App\Models\BalanceHistory;
use App\Models\Box;
use App\Models\BoxOrder;
use App\Models\Delivery;
use App\Models\Direction;
use App\Models\Order;
use App\Models\ReportBalanceHistory;
use App\Models\ReportMonthly;
use App\Models\ReportDaily;
use App\Models\Send;
use App\Models\Shipping;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Facade\FlareClient\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        // $ordersCount = Order::whereIn('status_id', [
        //     Order::STATUS_RECEPTION_ORDER,
        //     Order::STATUS_SEND,
        //     Order::STATUS_RECEPTION_DUSHANBE
        // ])->count();

        // $reception_orders   = Order::where('status_id', Order::STATUS_RECEPTION_ORDER)->count();
        // $reception_dushanbe = Order::where('status_id', Order::STATUS_RECEPTION_DUSHANBE)->count();
        // $send_orders        = Order::where('status_id', Order::STATUS_SEND)->count();

        return response()->json([
        //     'reception_orders_percent'   => round($reception_orders * 100 / $ordersCount, 2),
        //     'reception_dushanbe_percent' => round($reception_dushanbe * 100 / $ordersCount, 2),
        //     'send_orders_percent'        => round($send_orders * 100 / $ordersCount, 2),

        //     'reception_orders'   => $reception_orders,
        //     'reception_dushanbe' => $reception_dushanbe,
        //     'send_orders'        => $send_orders,
            
        //     'ordersCount'        => $ordersCount

            "users_count" => User::where([
                'is_active' => 1,
                'employer'  => 0
            ])->count(),

            "employees_count" => User::where([
                'is_active' => 1,
                'employer'  => 1
            ])->count(),

            "box_weight" => Order::where('status_id', Order::STATUS_PACKING)->sum('weight'),
            "box_total"  => Order::where('status_id', Order::STATUS_PACKING)->count(),
            "box_cost"   => Order::where('status_id', Order::STATUS_PACKING)->sum('cost'),

            "send_weight" => Order::where('status_id', Order::STATUS_SEND)->sum('weight'),
            "send_total"  => Order::where('status_id', Order::STATUS_SEND)->count(),
            "send_cost"   => Order::where('status_id', Order::STATUS_SEND)->sum('cost'),

            "reception_weight" => Order::where('status_id', Order::STATUS_RECEPTION_ORDER)->sum('weight'),
            "reception_total"  => Order::where('status_id', Order::STATUS_RECEPTION_ORDER)->count(),
            "reception_cost"   => Order::where('status_id', Order::STATUS_RECEPTION_ORDER)->sum('cost'),

            "reception_dushanbe_weight" => Order::where('status_id', Order::STATUS_RECEPTION_DUSHANBE)->sum('weight'),
            "reception_dushanbe_total"  => Order::where('status_id', Order::STATUS_RECEPTION_DUSHANBE)->count(),
            "reception_dushanbe_cost"   => Order::where('status_id', Order::STATUS_RECEPTION_DUSHANBE)->sum('cost'),
        ]);
    }

    public function uploadFiles(Request $request, $dir='files')
    {
        $validated = request()->validate([
            'file'=> 'required',
        ]);

        if ($request->file('file')){
            $file = $request->file('file')->store($dir, ['disk' => 'public']);
        }

        return response()->json(['filePath'=>"/storage/$file"]);
    }

    public function getData(Request $request) {
        $data = [];

        if ($request->directions) {
            $data['directions'] = Direction::get();
        }
        if ($request->deliveries) {
            $data['deliveries'] = Delivery::get();
        }
        if ($request->shippings) {
            $data['shippings'] = Shipping::get();
        }
        if ($request->users) {
            $data['users'] = User::where('employer', 0)->where('client_code', '<>', 'null')->orderBy('id', 'desc')->get();
        }
        if ($request->order_statuses) {
            $data['order_statuses'] = Status::where('status_resource_id', Order::STATUS_RESOURCE_ID)->get();
        }
        if ($request->box_statuses) {
            $data['box_statuses'] = Status::where('status_resource_id', Box::STATUS_RESOURCE_ID)->get();
        }
        if ($request->send_statuses) {
            $data['send_statuses'] = Status::where('status_resource_id', Send::STATUS_RESOURCE_ID)->get();
        }
        if ($request->orders) {
            $data['orders'] = Order::with('user:id,client_code', 'status:id,name')
                ->where('status_id', $request->orders) // Order::STATUS_RECEPTION_ORDER
                ->orderBy('id', 'desc')->get();
        }
        if ($request->dushanbe_orders) {
            $data['orders'] = Order::with('user:id,client_code', 'status:id,name')
                ->where('status_id', Order::STATUS_RECEPTION_DUSHANBE) // Order::STATUS_RECEPTION_ORDER
                ->orderBy('id', 'desc')->get();
        }
        if ($request->boxes) {
            $data['boxes'] = Box::with('status:id,name')
                ->where('status_id', $request->boxes) // Box::STATUS_CREATED
                ->orderBy('id', 'desc')->get();
        }

        return response()->json($data);
    }

    public function getKanban(Request $request) {
        $data = [];

        if ($request->orders) {
            $data['orders'] = Order::with('status:id,name', 'user')
                ->whereIn('status_id', [
                    Order::STATUS_RECEPTION_ORDER,
                ])
                ->orderBy('id', 'desc')
                ->paginate(12);
        }
        if ($request->boxes) {
            $data['boxes'] = Box::withCount('orders')
                ->with('orders', 'status:id,name')
                ->wherein('status_id', [
                    Box::STATUS_CREATED,
                ])
                ->orderBy('id', 'desc')->paginate(12);
        }
        if ($request->sends) {
            $data['sends'] = Send::withCount('boxes')
                ->with('boxes', 'status:id,name')
                ->where('status_id', [
                    Send::STATUS_CREATED
                ])
                ->orderBy('id', 'desc')->paginate(12);
        }
        if ($request->reseption_dushanbe) {
            $data['reseption_dushanbe'] = Box::withCount('orders')
                ->with('orders', 'status:id,name')
                ->where('status_id', Box::STATUS_RECEPTION_DUSHANBE)
                ->orderBy('id', 'desc')->paginate(12);
        }
        if ($request->returns) {
            $data['returns'] = Order::with('status:id,name', 'user')
                ->where('status_id', Order::STATUS_RECEPTION_DUSHANBE)
                ->orderBy('id', 'desc')->paginate(12);
        }
        if ($request->all) {
            $data['orders'] = Order::with('status:id,name', 'user')
                ->whereIn('status_id', [
                    Order::STATUS_RECEPTION_ORDER,
                ])
                ->orderBy('id', 'desc')
                ->paginate(12);
            $data['boxes'] = Box::withCount('orders')
                ->with('orders', 'status:id,name')
                ->wherein('status_id', [
                    Box::STATUS_CREATED,
                ])
                ->orderBy('id', 'desc')->paginate(12);
            $data['sends'] = Send::withCount('boxes')
                ->with('boxes', 'status:id,name')
                ->where('status_id', [
                    Send::STATUS_CREATED
                ])
                ->orderBy('id', 'desc')->paginate(12);
            $data['reseption_dushanbe'] = Box::withCount('orders')
                ->with('orders', 'status:id,name')
                ->where('status_id', Box::STATUS_RECEPTION_DUSHANBE)
                ->orderBy('id', 'desc')->paginate(12);
            $data['returns'] = Order::with('status:id,name', 'user')
                ->where('status_id', Order::STATUS_RECEPTION_DUSHANBE)
                ->orderBy('id', 'desc')->paginate(12);
        }

        return response()->json($data);
    }

    public function remainOrders()
    {
        return response()->json([
            'remain_orders' => Order::with('user:id,name', 'direction:id,name')
                ->where('status_id', Order::STATUS_RECEPTION_DUSHANBE)
                ->where('updated_at', '<', Carbon::now()->subDay(30))
                ->orderBy('id', 'desc')
                ->get()
        ]);
    }

    public function balanceHistories() {
        return response()->json([
            'pay_histories' => BalanceHistory::with('order')
                ->orderBy('id', 'desc')
                ->get()
        ]);
    }

    public function reportDaily()
    {
        return response()->json([
            'reports' => ReportDaily::with('daily_report_orders', 'status:id,name,status_resource_id')->get()
        ]);
    }

    public function reportDailyShow($id)
    {
        return response()->json([
            'report' => ReportDaily::with('daily_report_orders', 'status:id,name,status_resource_id')->find($id)
        ]);
    }

    public function reportDailyChangeStatus($id, Request $request)
    {
        ReportDaily::find($id)->update(['status_id' => $request->status_id]);
    }

    public function reportMonthly()
    {
        return response()->json([
            'reports' => ReportMonthly::with('monthly_report_orders', 'status:id,name,status_resource_id')->get()
        ]);
    }

    public function reportMonthlyShow($id)
    {
        return response()->json([
            'report' => ReportMonthly::with('monthly_report_orders', 'status:id,name,status_resource_id')->find($id)
        ]);
    }

    public function reportMonthlyChangeStatus($id, Request $request)
    {
        ReportMonthly::find($id)->update(['status_id' => $request->status_id]);
    }

    public function getExpenses($type = 'daily')
    {
        if ($type === 'daily') {
            return response()->json([
                'expenses' => ReportBalanceHistory::where('type', 0)->get()
            ]);
        }
        else if ($type === 'monthly') {
            return response()->json([
                'expenses' => ReportBalanceHistory::where('type', 1)->get()
            ]);
        }

        abort(403);
    }

    public function getAnalitics(Request $request)
    {
        if ($request->start && $request->end) {
            $ordersCost = Order::where('created_at', '>=', Carbon::parse($request->start))->where('created_at', '<=', Carbon::parse($request->end))->sum('cost');
            $ordersCostChina = Order::where('created_at', '>=', Carbon::parse($request->start))->where('created_at', '<=', Carbon::parse($request->end))->sum('cost_china');
            $ordersCount = Order::where('created_at', '>=',Carbon::parse($request->start))->where('created_at', '<=', Carbon::parse($request->end))->count();
            $ordersWeight = Order::where('created_at', '>=', Carbon::parse($request->start))->where('created_at', '<=', Carbon::parse($request->end))->sum('weight');

            return response()->json([
                'orders_cost' => $ordersCost + $ordersCostChina,
                'orders_count' => $ordersCount,
                'orders_weight' => $ordersWeight,
            ]);
        }

        abort(403);
    }

    public function changeReturnOrders(Request $request)
    {
        foreach($request->orders as $order) {
            $order = Order::whereIn('status_id', [
                    Order::STATUS_RECEPTION_ORDER,
                    Order::STATUS_PACKING,
                    Order::STATUS_SEND,
                ])->find($order);
            if (!$order) {
               abort(403); 
            }
            $order->update([
                'status_id' => Order::STATUS_RETURN
            ]);
        }

        return response()->json([
            'message' => 'Данные успешно обновлени'
        ]);
    }

    public function changeReturnBoxes(Request $request)
    {
        foreach($request->boxes as $box) {
            Box::find($box)->update([
                'status_id' => Box::STATUS_RETURN
            ]);
        }

        $orders = BoxOrder::whereIn('box_id', $request->boxes)->pluck('order_id'); 
        foreach($orders as $order) {
            $order = Order::whereIn('status_id', [
                    Order::STATUS_RECEPTION_ORDER,
                    Order::STATUS_PACKING,
                    Order::STATUS_SEND,
                ])->find($order);
            if ($order) {
                $order->update([
                    'status_id' => Order::STATUS_RETURN
                ]);
            }
        }

        return response()->json([
            'message' => 'Данные успешно обновлени'
        ]);
    }
}
