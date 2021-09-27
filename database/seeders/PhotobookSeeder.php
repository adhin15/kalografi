<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotobookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::today();
        DB::table('photobooks')->insert([
           [
               'photobook' => 'Wedding Photobook 20cm x 30cm',
               'price' => 400000,
               'created_at' => date($today),
               'updated_at' => date($today)
           ]
        ]);
    }
}
