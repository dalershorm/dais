<?php

namespace App\Http\Controllers;

use App\Http\Requests\employerDashboardRequest;
use App\Http\Requests\EmployerRequest;
use App\Models\EmployerBalanceHistory;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $users = User::where('employer', 1);

        if (request('name')) {
            $users->where('name', 'like', '%' . request('name') . '%');
        }

        if (request('phone')) {
            $users->where('phone', 'like', '%' . request('phone') . '%');
        }

        if (request('register_date')) {
            $users->whereBetween('created_at', [Carbon::parse(request('register_date'))->copy()->startOfDay(), Carbon::parse(request('register_date'))->copy()->endOfDay()]);
        }

        if ($request->has('is_active') && $request->is_active != '') {
            $users->where('is_active', request('is_active'));
        }

        return response()->json([
            'employees' => $users->orderBy('id', 'desc')->get()->makeVisible('balance'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EmployerRequest $request)
    {
        $user = User::create($request->all() + [
            'employer' => 1,
        ]);

        if ( $request->balance > 0 ) {
            EmployerBalanceHistory::create([
                'user_id' => $user->id,
                'balance' => $request->balance,
                'description'=> $request->description
            ]);
        }

        if ($request->roles) {
            $user->syncRoles($request->roles);
        }

        return response()->json([
            'message' => 'Данные успешно добавлении'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json([
            'employer' => User::with('roles')->where('employer', 1)->find($id)->makeVisible('balance'),
            'roles'=> Role::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EmployerRequest $request, $id)
    {
        $user = User::find($id);
        $user->update(array_merge($request->all(), [
            'balance' => $request->new_balance > 0 ? $user->balance + $request->new_balance : $user->balance 
        ]));

        if ( $request->new_balance > 0 ) {
            EmployerBalanceHistory::create([
                'user_id' => $user->id,
                'balance' => $request->new_balance,
                'description'=> $request->description
            ]);
        }

        if ($request->roles) {
            $user->syncRoles($request->roles);
        }

        return response()->json([
            'message' => 'Данные успешно обновлени'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::where('employer', 1)->find($id);
        if (!$user) {
            abort(404);
        }
        $user->delete();
        return response()->json([
            'message' => 'Запись удаленно'
        ]);
    }
}
