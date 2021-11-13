<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'roles'=> Role::with('permissions')->get(),
            'permissions'=> Permission::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'display_name'=> 'required',
            'permissions'=> 'required',
//            'description'=> 'required'
        ]);

        $role = Role::create([
            'name'=> $request->name,
            'display_name'=> $request->display_name,
//            'description'=> $request->description
        ]);

        $role->syncPermissions($request->permissions);

        return response()->json([
            'role'=> Role::with('permissions')->find($role->id),
            'message'=> 'Запись успешно добавлени'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Role $role)
    {
        return response()->json([
            'role'=> $role->load('permissions'),
            'permissions'=> Permission::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name'=> 'required',
            'display_name'=> 'required',
//            'description'=> 'required'
        ]);

        $role->update([
            'name'=> $request->name,
            'display_name'=> $request->display_name,
            'description'=> $request->description,
        ]);

        $role->syncPermissions($request->permissions);

        return response()->json([
            'role'=> Role::with('permissions')->find($role->id),
            'message'=> 'Запись успешно обновлен'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([
            'message'=> 'Запись удалён',
        ]);
    }
}
