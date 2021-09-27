<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideographerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::today();
        DB::table('videographers')->insert([
            [
                'amount' => '1',
                'price' => 1500000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'amount' => '2',
                'price' => 2200000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'amount' => '3',
                'price' => 2900000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ]
        ]);
    }
}
