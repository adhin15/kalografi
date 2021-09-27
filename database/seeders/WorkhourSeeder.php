<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkhourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::today();
        DB::table('workhours')->insert([
            [
                'amount' => '2',
                'price' => 200000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'amount' => '4',
                'price' => 400000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'amount' => '6',
                'price' => 600000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'amount' => '8',
                'price' => 800000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'amount' => '10',
                'price' => 1000000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'amount' => '12',
                'price' => 1200000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'amount' => '15',
                'price' => 1500000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ]
        ]);
    }
}
