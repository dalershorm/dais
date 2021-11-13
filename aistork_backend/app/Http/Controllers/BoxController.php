<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoxRequest;
use App\Jobs\SendSMSJob;
use App\Models\Box;
use App\Models\BoxOrder;
use App\Models\Direction;
use App\Models\Order;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $box = Box::withCount('orders')->with('orders', 'status');
        $box->where('employer_id', auth()->user()->id);

        return response()->json([
            'boxes' => $box->orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BoxRequest $request)
    {
        $box = Box::create($request->all() + ['name'=> 'Упаковка', 'employer_id' => auth()->user()->id]);
        $box->name = "BX" . random_int(10000000, 99999999);
        $box->save();

        $box->orders()->sync($request->orders);

        $this->setStatuses($request->status_id, $request->orders);

        return response()->json([
            'message' => 'Данные успешно добавлени'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Box $box)
    {
        // if ($this->checkAccess($box)){
        //     return response()->json([

        //     ], 403);
        // }   Просмотреть надо сделать так чтоб во всех статусах можно было смотерть

        $box->load('orders', 'status', 'orders.status', 'orders.user:id,client_code')->loadCount('orders');

        $order_ids = [];
        foreach ($box->orders as $order) {
            array_push($order_ids, $order->id);
        }
        return response()->json([
            'box' => $box,
            'orders' => Order::with('user:id,client_code', 'status:id,name')->whereIn('id', $order_ids)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BoxRequest $request, Box $box)
    {
        if ($this->checkAccess($box)){
            return response()->json([

            ], 403);
        }
        $box->update($request->all());

        $box->orders()->sync($request->orders);

        return response()->json([
            'message' => 'Данные успешно обновлени'
        ]);
    }

    public function reception(Request $request)
    {
        
        if (is_array($request->boxes)) {
            foreach ($request->boxes as $boxId) {
                $box = Box::find($boxId);
                $box->update([
                    'status_id' => Box::STATUS_RECEPTION_DUSHANBE
                ]);
                foreach ($box->orders as $order) {
                    Order::find($order->id)->update([
                        'status_id' => Order::STATUS_RECEPTION_DUSHANBE
                    ]);
                }
            }
            
            $orders = BoxOrder::whereIn('box_id', $request->boxes)->pluck('order_id');
            SendSMSJob::dispatch(Order::with('user')->whereIn('id', $orders)->get());
            
            return response()->json([
                'message' => 'Данные успешно обновлени'
            ]);
        }
        

        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Box $box)
    {
        if ($this->checkAccess($box)){
            return response()->json([

            ], 403);
        }
        $box->delete();
        return response()->json([
            'message' => 'Запись удаленно'
        ]);
    }

    private function checkAccess($box) {
        if (in_array($box->status_id, [
                Box::STATUS_SEND,
                Box::STATUS_RECEPTION_DUSHANBE,
            ]) || $box->employer_id !== auth()->user()->id) {
            return true;
        }

        return false;
    }

    private function setStatuses($status_id, $orders) {
        if (in_array($status_id, [
            Box::STATUS_CREATED,
            Box::STATUS_SEND,
            Box::STATUS_RECEPTION_DUSHANBE,
        ])) {
            foreach ($orders as $orderId) {
                Order::find($orderId)->update([
                    'status_id' => $status_id === Box::STATUS_CREATED ? Order::STATUS_PACKING : ($status_id === Box::STATUS_SEND ? Order::STATUS_SEND : Order::STATUS_RECEPTION_DUSHANBE)
                ]);
            }
        }
    }
}
