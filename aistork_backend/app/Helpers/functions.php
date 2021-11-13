<?php

use App\Models\AlgorithmMainPage;
use App\Models\Announcement;
use App\Models\AnnouncementPaymentHistory;
use App\Models\PaymentTarif;
use App\Models\User;
use App\Models\Visitor;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;

function checkPaymentTarif($userId, $paymentTarifId) {
    $paymentTarif = PaymentTarif::where('is_active', 1)->find($paymentTarifId);
    if (!$paymentTarif) {
        return [
            'message'=> 'Тариф не существует',
            'status'=> false
        ];
    } else {
        $user = User::where('is_active', 1)->find($userId);
        if (!$user) {
            return [
                'message'=> 'Пользователь не существует',
                'status'=> false
            ];
        } else {
            $balance = $user->balance;
            $payment_per_month = $user->payment_per_month;
            $pm = isset($payment_per_month) && $payment_per_month > 0 ? $payment_per_month * $paymentTarif->month : $paymentTarif->price;
            $discount = isset($paymentTarif->discount) && $paymentTarif->discount > 0 ? ($pm * $paymentTarif->discount) / 100 : 0;

            if ($balance >= ($pm - $discount)) {
                return [
                    'price'             => $paymentTarif->price,
                    'discount'          => $paymentTarif->discount,
                    'payment_per_month' => $payment_per_month,
                    'discountPrice'     => ($pm - $discount),
                    'month'             => (int)$paymentTarif->month,
                    'status'            => true,
                ];
            } else {
                return [
                    'message'=> 'У вас недостаточно средств на балансе',
                    'status'=> false
                ];
            }
        }
    }
}

function setPaymentTarif($announcement, $res)
{
    $currentDateTime = Carbon::now();
    $paid_before = $currentDateTime->addMonth($res['month']);

    $announcementPaymentHistory = AnnouncementPaymentHistory::create([
        'price'             => $res['price'],
        'payment_per_month' => $res['payment_per_month'],
        'discount'          => $res['discount'],
        'discountPrice'     => $res['discountPrice'],
        'paid_at'           => $currentDateTime,
        'paid_before'       => $paid_before,
        'announcement_id'   => $announcement->id
    ]);

    $user = User::find($announcement->user->id);
    $user->update([
        'balance'=> $user->balance - $res['discountPrice']
    ]);
    
    return [
        'paid_before' => $announcementPaymentHistory->paid_before
    ];
}

function sendSMS($phone, $confirmCode)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mdo.payvand.tj/payments/SendMessage',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'[
            {
                "source-address": "bino.tj",
                "destination-address": "' . checkPhoneNumber($phone) . '",
                "data-encoding": 0,
                "txn-id": ' . time() . ',
                "message": "Vash code: ' . $confirmCode . '."
            }
        ]',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Api-Key: 7B333135-B56B-46C7-AED1-60419D457067',
            'Locale: EN'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function checkPhoneNumber($phone)
{
    return str_replace(array( '(', ')', ' ', '-' ), '', $phone);
}

function sumAlgorithm($algorithmMainPage) {
    return (
        $algorithmMainPage->rating + 
        $algorithmMainPage->favorite + 
        $algorithmMainPage->unique_users + 
        $algorithmMainPage->search_builders + 
        $algorithmMainPage->views + 
        $algorithmMainPage->call_button + 
        $algorithmMainPage->feedback
    ) == 100 ? true : false;
}


function setVisitor($announcementId, $request)
{
    $visitor = Visitor::where([
        "ip"=> $request->ip(),
        "browser"=> $request->header('User-Agent'),
        "announcement_id"=> $announcementId,
    ])->where(
        'visit_date', '>=', Carbon::now()->subDays(1)
    )->count();
    if ($visitor < 1) {
        Visitor::create([
            "ip"=> $request->ip(),
            "browser"=> $request->header('User-Agent'),
            "announcement_id"=> $announcementId,
            'visit_date' => Carbon::now()
        ]);
    }
}

function filterAlgorithm() {
    $newBuildings = Announcement::withCount('favorites', 'request_call', 'cal_histories')->with('visitors')->paid()->active()->where('type', 1)->get();
    $algorithmMainPage = AlgorithmMainPage::find(1);

    // return count($newBuildings->cal_histories);

    // sumRating
    // favorites_count
    // count($newBuildings->visitors)
    // builder -----
    // count($newBuildings->visitors->unique("announcement_id")
    // cal_histories_count
    // request_call_count

    $data = [];

    foreach ($newBuildings as $newBuilding) {
        $data[$newBuilding->id] = (
            $newBuilding->sumRating * ($algorithmMainPage->rating / 100) +
            $newBuilding->favorites_count * ($algorithmMainPage->favorite / 100) +
            count($newBuilding->visitors) * ($algorithmMainPage->views / 100) +
            count($newBuilding->visitors->unique("announcement_id")) * ($algorithmMainPage->unique_users / 100) +
            $newBuilding->cal_histories_count * ($algorithmMainPage->call_button / 100) +
            $newBuilding->request_call_count * ($algorithmMainPage->feedback / 100)
        );
    }
    arsort($data);
    return array_keys($data);
}

function basicAuth($header) {
    $data = explode(':', base64_decode(str_replace('Basic ', '', $header)));
   
    if (count($data) == 2) {
        $user = User::where([
            'phone'=> $data[0],
            'is_active'=> 1,
        ])->first();
        if ($user && Hash::check($data[1], $user->password)) {
            return true;
        }
    }

    return false;
}