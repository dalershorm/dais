<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\ReportDaily;
use App\Models\ReportRest;
use App\Models\ReportRestOrder;
use App\Models\ReportRestOrderDaily;
use App\Models\ReportRestOrderMonthly;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReportRestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:rest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create report rest orders daily and monthly';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $daily_orders = ReportRestOrderDaily::pluck('order_id');
        $orders = Order::where('status_id', Order::STATUS_REST)
                            ->whereNotIn('id', $daily_orders)
                            ->where('updated_at', '>=', Carbon::parse('-24 hours'))
                            ->pluck('id');
        
        $costs = Order::where('status_id', Order::STATUS_REST)
                            ->whereNotIn('id', $daily_orders)
                            ->where('updated_at', '>=', Carbon::parse('-24 hours'))
                            ->sum('cost');
        $costs_ch = Order::where('status_id', Order::STATUS_REST)
                            ->whereNotIn('id', $daily_orders)
                            ->where('updated_at', '>=', Carbon::parse('-24 hours'))
                            ->sum('cost_china');
        $weight = Order::where('status_id', Order::STATUS_REST)
                            ->whereNotIn('id', $daily_orders)
                            ->where('updated_at', '>=', Carbon::parse('-24 hours'))
                            ->sum('weight');

        if (count($orders) > 0) {
            $rd = ReportRest::create([
            'cost' => (float)$costs + (float)$costs_ch,
            'weight' => $weight,
            'total' => count($orders),
            'status_id' => ReportDaily::STATUS_CREATED,
            'report_date' => Carbon::now()
        ]);

            $rd->report_rest_order_dailies()->sync($orders);
        }

        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfDay = Carbon::now()->startOfDay();
        if  ($startOfMonth == $startOfDay) {
            $start = new Carbon('first day of last month');
            $end = new Carbon('last day of last month');
            
            $monthly_orders = ReportRestOrderMonthly::pluck('order_id');
            $orders = Order::where('status_id', Order::STATUS_REST)
                                ->whereNotIn('id', $monthly_orders)
                                ->where('updated_at', '>=', $start)
                                ->where('updated_at', '<=', $end)
                                ->pluck('id');
            
            $costs = Order::where('status_id', Order::STATUS_REST)
                                ->whereNotIn('id', $monthly_orders)
                                ->where('updated_at', '>=', $start)
                                ->where('updated_at', '<=', $end)
                                ->sum('cost');
            $costs_ch = Order::where('status_id', Order::STATUS_REST)
                                ->whereNotIn('id', $monthly_orders)
                                ->where('updated_at', '>=', $start)
                                ->where('updated_at', '<=', $end)
                                ->sum('cost_china');
            $weight = Order::where('status_id', Order::STATUS_REST)
                                ->whereNotIn('id', $monthly_orders)
                                ->where('updated_at', '>=', $start)
                                ->where('updated_at', '<=', $end)
                                ->sum('weight');
            if (count($orders) > 0) {
                $rd = ReportRest::create([
                    'cost' => (float)$costs + (float)$costs_ch,
                    'weight' => $weight,
                    'total' => count($orders),
                    'status_id' => ReportDaily::STATUS_CREATED,
                    'report_date' => Carbon::now(),
                    'type' => 1
                ]);

                // $data = [];
                // foreach ($orders as $order) {
                //     $data[$order] = [
                //         'type' => 1
                //     ];
                // } 
                $rd->report_rest_order_monthlies()->sync($orders);
            }
        }
    }
}
