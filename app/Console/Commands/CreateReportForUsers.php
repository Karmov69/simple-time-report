<?php

namespace App\Console\Commands;

use App\Notifications\ReportCreated;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Role as RoleConst;

class CreateReportForUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $users = User::whereHas('roles', function($q){
            $q->where('name', RoleConst::ROLE_USER);
        })->get();

        $users->each(function($user) {
            $now = Carbon::now();
            $reportStartDate = clone $now;
            $reportStartDate = $reportStartDate->subDays($reportStartDate->dayOfWeekIso-1)->startOfDay();
            $reportEndDate = clone $reportStartDate;
            $reportEndDate = $reportEndDate->addDays(6)->endOfDay();
            $reportStartDate = Carbon::createFromFormat('Y-m-d H:i:s', $reportStartDate)
                ->format('d-m-Y');
            $reportEndDate = Carbon::createFromFormat('Y-m-d H:i:s', $reportEndDate)
                ->format('d-m-Y');

            DB::table('reports')->insert(
                [
                    'user_id' => $user->id,
                    'author' => $user->name . ' ' . $user->lastname,
                    'plane_hours' => $user->plane_hours,
                    'fact_hours' => 0,
                    'week_hours' => 0,
                    'effective_hours' => 0,
                    'report_start_date' => $reportStartDate,
                    'report_end_date' => $reportEndDate
                ]
            );
        });

        // @todo пахнет
        $firstUser = User::query()
            ->firstOrFail();

        Notification::send($firstUser, new ReportCreated());
    }
}

