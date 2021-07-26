<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LoanPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('loan_plans')->insert([[
            'name' => 'small',
            'description' => '6 months',
            'type' => 'month',
            'duration' => 30,
            'interest_rate' => 5,
            'penalty_rate' => 2,
        ], [
            'name' => 'medium',
            'description' => '2 years and 3 months',
            'type' => 'mix',
            'duration' => 760,
            'interest_rate' => 6,
            'penalty_rate' => 2,
        ], [
            'name' => 'large',
            'description' => 'over 3 years',
            'type' => 'year',
            'duration' => 1095,
            'interest_rate' => 8,
            'penalty_rate' => 3,
        ]]);
    }
}
