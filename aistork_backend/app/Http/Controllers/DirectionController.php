<?php

namespace App\Http\Controllers;

use App\Http\Requests\DirectionRequest;
use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'directions' => Direction::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DirectionRequest $request)
    {
        Direction::create($request->all());

    return response()->json([
        'message' => 'Данные успешно добавлени'
    ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Direction $direction
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Direction $direction)
    {
        return response()->json([
            'direction' => $direction,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Direction $direction
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DirectionRequest $request, Direction $direction)
    {
        $direction->update($request->all());

        return response()->json([
            'message' => 'Данные успешно обновлени'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Direction $direction
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Direction $direction)
    {
        $direction->delete();
        return response()->json([
            'message' => 'Запись удаленно'
        ]);
    }
}
