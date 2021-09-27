<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::today();
        DB::table('additionals')->insert([
            [
                'name' => 'Drone Footage',
                'price' => 1200000,
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => 'Flashdisk',
                'price' => 100000,
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => '1 Minute Cinematic',
                'price' => 1500000,
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => 'Live Streaming',
                'price' => 3500000,
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => '3 Minute Cinematic Video',
                'price' => 2750000,
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
            [
                'name' => 'Full Documentation Video',
                'price' => 2000000,
                'created_at' => date($today),
                'updated_at' => date($today),
            ],
        ]);
    }
}
