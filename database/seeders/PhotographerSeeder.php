<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotographerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::today();
        DB::table('photographers')->insert([
            [
                'amount' => '1',
                'price' => 500000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'amount' => '2',
                'price' => 1000000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'amount' => '3',
                'price' => 1500000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ]
        ]);
    }
}
