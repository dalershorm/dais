<?php

namespace App\Console\Commands;

use App\Models\EmployerBalanceHistory;
use App\Models\ReportBalanceHistory;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReportBalanceHistoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Report balance histories';

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
        $balance = EmployerBalanceHistory::where('created_at', '>=', Carbon::parse('-24 hours'))->sum('balance');
        // echo  $balance;
        ReportBalanceHistory::create([
            'price' => $balance
        ]);

        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfDay = Carbon::now()->startOfDay();
        if  ($startOfMonth == $startOfDay) {
            $start = new Carbon('first day of last month');
            $end = new Carbon('last day of last month');
            $balance = EmployerBalanceHistory::where('created_at', '>=', $start)
                                                ->where('created_at', '>=', $start)
                                                ->where('created_at', '<=', $end)
                                                ->sum('balance');
            // echo  $balance;
            ReportBalanceHistory::create([
                'price' => $balance,
                'type'  => 1
            ]);
        }
    }
}
