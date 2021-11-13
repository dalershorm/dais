<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('orders')) {
            return response()->json([
                'orders'=> Order::with('user:id,name,client_code')->where('status_id', Order::STATUS_RECEPTION_DUSHANBE)->get(),
            ]);
        }
        return response()->json([
            'payments' => Payment::with('user:id,name,client_code', 'payment_orders')
                                    ->orderBy('id', 'desc')->get()
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
    public function store(PaymentRequest $request)
    {
        $orders = Order::where('status_id', Order::STATUS_RECEPTION_DUSHANBE)
                        ->whereIn('id', $request->orders)
                        ->pluck('id');

        if (count($orders) < 1) {
            return response()->json([
                'message' => 'Введены некорректные данные'
            ], 403);
        }

        $payment = Payment::create($request->all() + ['employer_id' => auth()->user()->id]);

        $payment->payment_orders()->sync($orders);

        foreach($orders as $order) {
            Order::find($order)->update(['status_id', Order::STATUS_PAY]);
        }

        return response()->json([
            'message' => 'Данные успешно добавлении'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return response()->json([
            'payment' => $payment->load('user:id,name,client_code,phone', 'payment_orders'),
            // 'orders'=> Order::where('status_id', Order::STATUS_RECEPTION_DUSHANBE)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
    }
}
