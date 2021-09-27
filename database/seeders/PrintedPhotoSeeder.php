<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrintedPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::today();
        DB::table('printedphotos')->insert([
            [
                'printedphoto' => 'Printed Photo 16R On Canvas + Frame',
                'price' => 300000,
                'created_at' => date($today),
                'updated_at' => date($today),
            ]
        ]);
    }
}
