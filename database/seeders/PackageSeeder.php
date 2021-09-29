<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::today();
        DB::table('packages')->insert([
            [
                'image_id' => 1,
                'photographer_id' => 2,
                'videographer_id' => 1,
                'workhour_id' => 2,
                'name' => 'Mahesa',
                'category' => 'Wedding Package',
                'day' => 'Half Day',
                'flashdisk' => 1,
                'edited' => '300',
                'price' => 3500000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_id' => 2,
                'photographer_id' => 2,
                'videographer_id' => 1,
                'workhour_id' => 7,
                'name' => 'Manendra',
                'category' => 'Wedding Package',
                'day' => 'Full Day',
                'flashdisk' => 1,
                'edited' => '500',
                'price' => 5500000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_id' => 3,
                'photographer_id' => 2,
                'videographer_id' => 2,
                'workhour_id' => 7,
                'name' => 'Mahawira',
                'category' => 'Wedding Package',
                'day' => 'Full Day',
                'flashdisk' => 1,
                'edited' => 'all',
                'price' => 7500000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_id' => 4,
                'photographer_id' => 1,
                'videographer_id' => 1,
                'workhour_id' => 2,
                'name' => 'Renjana',
                'category' => 'Pre-Wedding Package',
                'day' => '-',
                'flashdisk' => 1,
                'edited' => '300',
                'price' => 2000000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_id' => 5,
                'photographer_id' => 2,
                'videographer_id' => 1,
                'workhour_id' => 2,
                'name' => 'Sekala',
                'category' => 'Pre-Wedding Package',
                'day' => '-',
                'flashdisk' => 1,
                'edited' => '125',
                'price' => 3000000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_id' => 6,
                'photographer_id' => 2,
                'videographer_id' => 1,
                'workhour_id' => 2,
                'name' => 'Asmaraloka',
                'category' => 'Pre-Wedding Package',
                'day' => '-',
                'flashdisk' => 1,
                'edited' => '200',
                'price' => 4750000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_id' => 7,
                'photographer_id' => 1,
                'videographer_id' => null,
                'workhour_id' => 2,
                'name' => 'Amerta',
                'category' => 'Engagement Package',
                'day' => '-',
                'flashdisk' => 0,
                'edited' => '50',
                'price' => 1500000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_id' => 8,
                'photographer_id' => 1,
                'videographer_id' => 1,
                'workhour_id' => 3,
                'name' => 'Arunika',
                'category' => 'Engagement Package',
                'day' => '-',
                'flashdisk' => 0,
                'edited' => '100',
                'price' => 2750000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
        ]);
    }
}
