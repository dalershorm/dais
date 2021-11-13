<?php

namespace App\Http\Controllers;

use App\Models\StatusResource;
use Illuminate\Http\Request;

class StatusResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'resources' => StatusResource::get() 
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
     * @param  \App\Models\StatusResource  $statusResource
     * @return \Illuminate\Http\Response
     */
    public function show(StatusResource $statusResource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatusResource  $statusResource
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusResource $statusResource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StatusResource  $statusResource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusResource $statusResource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusResource  $statusResource
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusResource $statusResource)
    {
        //
    }
}
