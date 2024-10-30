<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansSeeder extends Seeder
{
    public function run()
    {
        DB::table('plans')->insert([
            [
                'plan_name' => 'Free',
                'plan_description' => 'something',
                'plan_price' => 0,
                'credits_per_month' => 30,
            ],
            [
                'plan_name' => 'Basic',
                'plan_description' => 'something',
                'plan_price' => 9.99,
                'credits_per_month' => 300,
            ],
            [
                'plan_name' => 'Pro',
                'plan_description' => 'something',
                'plan_price' => 19.99,
                'credits_per_month' => 3000,
            ],
            [
                'plan_name' => 'Premium',
                'plan_description' => 'something',
                'plan_price' => 29.99,
                'credits_per_month' => 30000,
            ],
        ]);
    }
}

