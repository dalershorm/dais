<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusDeliveryRequest;
use App\Models\Delivery;
use App\Models\DeliveryOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'deliveries' => Delivery::with('delivery_orders', 'status:id,name')
                                ->orderBy('id', 'desc')
                                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        return response()->json([
            'delivery' => $delivery->load('delivery_orders', 'status:id,name')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(StatusDeliveryRequest $request, Delivery $delivery)
    {
        // if ($request->status_id == Delivery::STATUS_DELIVERY || $request->status_id == Delivery::STATUS_PAID)
        $delivery->update([
            'status_id' => $request->status_id
        ]);

        if ($request->status_id == Delivery::STATUS_PAID) {
            $orders = DeliveryOrder::where('delivery_id', $delivery->id)->pluck('order_id');

            foreach($orders as $order) {
                Order::find($order)->update([
                    'status_id' => Order::STATUS_PAY
                ]);
            }
        }

        return response()->json([
            'message' => 'Данные успешно обновлени'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        //
    }
}
