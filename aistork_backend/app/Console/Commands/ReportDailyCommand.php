<?php

namespace App\Console\Commands;

use App\Models\DailyReportOrders;
use App\Models\Order;
use App\Models\ReportDaily;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReportDailyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create report orders daily';

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
        $daily_orders = DailyReportOrders::pluck('order_id');
        $orders = Order::where('status_id', Order::STATUS_PAY)
                            ->whereNotIn('id', $daily_orders)
                            ->where('updated_at', '>=', Carbon::parse('-24 hours'))
                            ->pluck('id');
        
        $costs = Order::where('status_id', Order::STATUS_PAY)
                            ->whereNotIn('id', $daily_orders)
                            ->where('updated_at', '>=', Carbon::parse('-24 hours'))
                            ->sum('cost');
        $costs_ch = Order::where('status_id', Order::STATUS_PAY)
                            ->whereNotIn('id', $daily_orders)
                            ->where('updated_at', '>=', Carbon::parse('-24 hours'))
                            ->sum('cost_china');
        $weight = Order::where('status_id', Order::STATUS_PAY)
                            ->whereNotIn('id', $daily_orders)
                            ->where('updated_at', '>=', Carbon::parse('-24 hours'))
                            ->sum('weight');
        // echo (float)$costs . ' s ' .  (float)$costs_ch;
        if ($orders) {
            $rd = ReportDaily::create([
            'cost' => (float)$costs + (float)$costs_ch,
            'weight' => $weight,
            'total' => count($orders),
            'status_id' => ReportDaily::STATUS_CREATED,
            'report_date' => Carbon::now()
        ]);

            $rd->daily_report_orders()->sync($orders);
        }
    }
}
