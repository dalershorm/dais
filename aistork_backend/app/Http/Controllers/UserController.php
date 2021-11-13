<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserDashboardRequest;
use App\Http\Requests\UserProfileRequest;
use App\Models\Announcement;
use App\Models\Role;
use App\Models\User;
use App\Models\City;
use App\Models\Builder;
use App\Models\SalesOffice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $users = User::with('direction:id,name')->where('employer', 0);

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
            'clients' => $users->orderBy('id', 'desc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(UserDashboardRequest $request)
    {
        $user = User::create($request->all());
        $hasClientCode = true;
        
        while($hasClientCode) {
            $client_code = str_split($user->name)[0] . '-' . random_int(1000, 9999);
            if (User::where('client_code', $client_code)->count() == 0) {
                $hasClientCode = false;
            }
        }
        $user->client_code = $client_code;
        $user->save();

        return response()->json([
            'user' => $user->load('direction'),
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
            'user' => User::with('direction:id,name')->where('employer', 0)->find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserDashboardRequest $request, $id)
    {
        $user = User::with('direction:id,name')->find($id);
        $user->update($request->all());

        return response()->json([
            'user' => $user,
            'message' => 'Данные успешно обновлени'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('employer', 0)->find($id);
        if (!$user) {
            abort(404);
        }
        $user->delete();
        return response()->json([
            'message' => 'Запись удаленно'
        ]);
    }
}
