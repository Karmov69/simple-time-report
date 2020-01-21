<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Report::class, function (Faker $faker) {
    $now = Carbon::now();
    $reportStartDate = clone $now;
    $reportStartDate = $reportStartDate
        ->subDays($reportStartDate->dayOfWeekIso-1)
        ->startOfDay();
    $reportEndDate = clone $reportStartDate;
    $reportEndDate = $reportEndDate->addDays(6)->endOfDay();
    $reportStartDate = Carbon::createFromFormat('Y-m-d H:i:s', $reportStartDate)
        ->format('d-m-Y');
    $reportEndDate = Carbon::createFromFormat('Y-m-d H:i:s', $reportEndDate)
        ->format('d-m-Y');

    return [
        'user_id' => 1,
        'author' => 'test_author',
        'plane_hours' => 40,
        'fact_hours' => '35',
        'week_hours' => '40',
        'effective_hours' => 24,
        'report_start_date' => $reportStartDate,
        'report_end_date' => $reportEndDate
    ];
});
