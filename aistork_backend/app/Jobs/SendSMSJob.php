<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use OsonSMS\SMSGateway\SMSGateway;

class SendSMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $orders; 

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->orders as $order) {
            $message = "Ваш заказ: " . $order->user->client_code . ". Трэк-код: " . $order->track_code . ". Прибыл в Душанбе и ожидает вас на складе.";
            $txn_id = uniqid();
            $result = SMSGateway::Send($order->user->phone, $message, $txn_id);
        }
    }
}
