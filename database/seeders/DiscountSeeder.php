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
                'nama' => 'diskon',
                'jumlah' => 25,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'nama' => 'Grand Opening',
                'jumlah' => 20,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
        ]);
    }
}
