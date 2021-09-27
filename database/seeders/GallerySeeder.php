<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::today();
        DB::table('galeris')->insert([
            [
                'image_one' => 'mahesa1.png',
                'image_two' => 'mahesa2.png',
                'image_three' => 'mahesa3.png',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one' => 'manendra1.png',
                'image_two' => 'manendra2.png',
                'image_three' => 'manendra3.png',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one' => 'mahawira1.jpg',
                'image_two' => 'mahawira2.jpg',
                'image_three' => 'mahawira3.jpg',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one' => 'renjana1.jpg',
                'image_two' => 'renjana2.jpg',
                'image_three' => 'renjana3.jpg',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one' => 'sekala1.jpg',
                'image_two' => 'sekala2.jpg',
                'image_three' => 'sekala3.jpg',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one' => 'asmaraloka1.jpg',
                'image_two' => 'asmaraloka2.jpg',
                'image_three' => 'asmaraloka3.jpg',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one' => 'amerta1.jpg',
                'image_two' => 'amerta2.jpg',
                'image_three' => 'amerta3.jpg',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one' => 'arunika1.jpg',
                'image_two' => 'arunika2.jpg',
                'image_three' => 'arunika3.jpg',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
        ]);
    }
}
