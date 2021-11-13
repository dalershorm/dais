<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendRequest;
use App\Jobs\SendSMSJob;
use App\Models\Box;
use App\Models\BoxOrder;
use App\Models\Order;
use App\Models\Send;
use Illuminate\Http\Request;

class SendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $send = Send::withCount('boxes')->with('boxes', 'status:id,name');
        $send->where('employer_id', auth()->user()->id);

        return response()->json([
            'sends' => $send->orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SendRequest $request)
    {
        $send = Send::create($request->all() + [
                'employer_id' => auth()->user()->id
            ]);

        $send->boxes()->sync($request->boxes);

        $this->setStatuses($request->status_id, $request->boxes);

        return response()->json([
            'message' => 'Данные успешно добавлени'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Send $send
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Send $send)
    {
        // if ($this->checkAccess($send)){
        //     return response()->json([

        //     ], 403);
        // } Просмотреть во надо сделать так чтоб во всех статусах можно было смотерть
        $send->load('boxes', 'status');

        $box_ids = [];
        foreach ($send->boxes as $box) {
            array_push($box_ids, $box->id);
        }
        return response()->json([
            'send' => $send,
            'boxes' => Box::with('status')
                ->whereIn('id', $box_ids)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Send $send
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SendRequest $request, Send $send)
    {
        if ($this->checkAccess($send)){
            return response()->json([

            ], 403);
        }
        $send->update($request->all());

        $send->boxes()->sync($request->orders);

        $this->setStatuses($request->status_id, $request->boxes);

        return response()->json([
            'message' => 'Данные успешно обновлени'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Send $send
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Send $send)
    {
        if ($this->checkAccess($send)){
            return response()->json([

            ], 403);
        }
        $send->delete();
        return response()->json([
            'message' => 'Запись удаленно'
        ]);
    }

    private function checkAccess($send) {
        if (in_array($send->status_id, [
                Send::STATUS_CREATED,
            ]) || $send->employer_id !== auth()->user()->id) {
            return true;
        }

        return false;
    }

    private function setStatuses($status_id, $box) {
        if (in_array($status_id, [
            Send::STATUS_CREATED,
            Send::STATUS_RECEPTION_DUSHANBE,
        ])) {
            foreach ($box as $boxId) {
                Box::find($boxId)->update([
                    'status_id' => $status_id === Send::STATUS_CREATED ? Box::STATUS_SEND : Box::STATUS_RECEPTION_DUSHANBE
                ]);

                foreach (BoxOrder::where('box_id', $boxId)->pluck('order_id') as $orderId) {
                    Order::find($orderId)->update([
                        'status_id' => $status_id === Send::STATUS_CREATED ? Order::STATUS_SEND : Order::STATUS_RECEPTION_DUSHANBE
                    ]);
                }
            }
        }
    }
}
