<?php

namespace App\Http\Controllers;

use App\Http\Requests\DirectionRequest;
use App\Http\Requests\ShippingRequest;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'shippings' => Shipping::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ShippingRequest $request)
    {
        Shipping::create($request->all());

        return response()->json([
            'message' => 'Данные успешно добавлени'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipping $shipping
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Shipping $shipping)
    {
        return response()->json([
            'shipping' => $shipping,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipping $shipping
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DirectionRequest $request, Shipping $shipping)
    {
        $shipping->update($request->all());

        return response()->json([
            'message' => 'Данные успешно обновлени'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipping $shipping
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        return response()->json([
            'message' => 'Запись удаленно'
        ]);
    }
}
