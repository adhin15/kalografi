<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::today();
        DB::table('discounts')->insert([
            [
                'name' => 'diskon',
                'amount' => 25,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'name' => 'Grand Opening',
                'amount' => 20,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
        ]);
    }
}
