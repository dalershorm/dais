<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidStoreRequest;
use App\Http\Requests\NumberCheckRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateInfoRequest;
use App\Http\Resources\UserResource;
use App\Models\Bid;
use App\Models\ConfirmPassword;
use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OsonSMS\SMSGateway\SMSGateway;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'numberCheck', 'createNewToken', 'changePassword']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // if ($request->dashboard && !User::where('phone', $request->phone)->first()->hasPermission('dashboard')) {
        //     return response()->json([
        //         'message'=> 'У вас нет разрешения.'
        //     ], 403);
        // }

        if (!$token = auth()->setTTL(45000)->attempt([
            'phone'=> $request->phone,
            'password'=> $request->password,
            'is_active' => 1
        ])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request) {

        $confirm = ConfirmPassword::where('phone', $request->phone)->where('confirmed', 1)->first();

        if (!$confirm) {
            return response()->json([
                'message' => 'Введены некорректные данные.',
            ], 403);
        }

        $user = User::create(array_merge(
            $request->validated(),
            [
                'password' => $request->password,
                'is_active' => 1,
            ]
        ));
        $hasClientCode = true;
        while($hasClientCode) {
            $client_code = str_split($user->name)[0] . '-' . random_int(1000, 9999);
            if (User::where('client_code', $client_code)->count() == 0) {
                $hasClientCode = false;
            }
        }
        $user->client_code = $client_code;
        $user->save();

        $txn_id = uniqid();
        $result = SMSGateway::Send($request->phone, 'Поздравляем вы успешно зарегистрировались. Ваш код клиента ' . $user->client_code, $txn_id);

        $confirm->delete();

        if (! $token = auth()->setTTL(45000)->attempt([
            'phone' => $request->phone,
            'password' => $request->password,
            'is_active' => 1
        ])) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }

        return $this->createNewToken($token);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        $user = User::find(auth()->user()->id);

        // if ($user->hasPermission('dashboard-read')) {
        // if (1) {
        //     $user->load('allPermissions');
        // }

        return response()->json(
            $user
        );
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function numberCheck(NumberCheckRequest $request) {
        if ($request->reset) {
            if (!User::where('phone', $request->phone)->count() > 0) {
                return response()->json([
                    'message' => 'Пользователь с таким телефоном не зарегистрирован.',
                ], 403);
            }
        } else {
            if (User::where('phone', $request->phone)->count() > 0) {
                return response()->json([
                    'message' => 'Пользователь с таким телефоном уже зарегистрирован.',
                ], 403);
            }
        }

        if ($request->confirm_code) {
            $confirm = ConfirmPassword::where('confirm_code', $request->confirm_code)->where('phone', $request->phone)->first();
            if (!$confirm) {
                return response()->json([
                    'message' => 'Введен неправильный код.',
                ], 403);
            }
            $confirm->update([
                'confirmed' => 1,
            ]);
            return response()->json([
                'confirmed' => true,
            ]);
        }

        if (ConfirmPassword::where('phone',$request->phone)->where('qty', '>=', 5)->where('updated_at', '>', Carbon::parse()->now()->subMinutes(60)->format('Y-m-d H:i:s'))->count() > 0) {
            return response()->json([
                'message' => 'Слишком много попыток, повторите позже!',
            ], 402);
        }

        $confirm_code = random_int(1000, 9999);

        $confirm = ConfirmPassword::updateOrCreate([
            'phone'=> $request->phone,
        ],[
            'phone'=> $request->phone,
            'confirm_code'=> $confirm_code,
            'qty'=> DB::raw('qty + 1'),
        ]);

        $txn_id = uniqid();
        $result = SMSGateway::Send($request->phone, 'Ваш код: ' . $confirm_code, $txn_id);

        // $smsResponse = sendSMS($request->phone, $confirm_code);

        // if (isset($smsResponse['transactions']['response'][0]['code'])) {
        //     return response()->json([
        //         'status'=> true
        //     ]);
        // }

        return response()->json([
            // 'confirm_code'=> $confirm_code
            // 'status'=> false
        ]);
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Пароль должен содержать не менее 6 символов.',
            ], 422);
        }

        $confirm = ConfirmPassword::where('phone', $request->phone)->where('confirmed', 1)->first();

        if (!$confirm) {
            return response()->json([
                'message' => 'Введены некорректные данные.',
            ], 403);
        }

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Пользователь с таким телефоном не зарегистрирован.',
            ], 403);
        }

        $user->update([
            'password' => $request->password
        ]);

        $confirm->delete();

        return response()->json([
            'message'=> 'Ваш пароль успешно обновлен'
        ]);
    }
}
