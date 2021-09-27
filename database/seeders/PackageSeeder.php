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
        DB::table('pakets')->insert([
            [
                'idgaleri' => 1,
                'photographer_id' => 2,
                'videographer_id' => 1,
                'workhour_id' => 2,
                'namapaket' => 'Mahesa',
                'kategori' => 'Wedding Package',
                'day' => 'Half Day',
                'flashdisk' => 1,
                'edited' => '300',
                'price' => 3500000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'idgaleri' => 2,
                'photographer_id' => 2,
                'videographer_id' => 1,
                'workhour_id' => 7,
                'namapaket' => 'Manendra',
                'kategori' => 'Wedding Package',
                'day' => 'Full Day',
                'flashdisk' => 1,
                'edited' => '500',
                'price' => 5500000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'idgaleri' => 3,
                'photographer_id' => 2,
                'videographer_id' => 2,
                'workhour_id' => 7,
                'namapaket' => 'Mahawira',
                'kategori' => 'Wedding Package',
                'day' => 'Full Day',
                'flashdisk' => 1,
                'edited' => 'all',
                'price' => 7500000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'idgaleri' => 4,
                'photographer_id' => 1,
                'videographer_id' => 1,
                'workhour_id' => 2,
                'namapaket' => 'Renjana',
                'kategori' => 'Pre-Wedding Package',
                'day' => '-',
                'flashdisk' => 1,
                'edited' => '300',
                'price' => 2000000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'idgaleri' => 5,
                'photographer_id' => 2,
                'videographer_id' => 1,
                'workhour_id' => 2,
                'namapaket' => 'Sekala',
                'kategori' => 'Pre-Wedding Package',
                'day' => '-',
                'flashdisk' => 1,
                'edited' => '125',
                'price' => 3000000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'idgaleri' => 6,
                'photographer_id' => 2,
                'videographer_id' => 1,
                'workhour_id' => 2,
                'namapaket' => 'Asmaraloka',
                'kategori' => 'Pre-Wedding Package',
                'day' => '-',
                'flashdisk' => 1,
                'edited' => '200',
                'price' => 4750000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'idgaleri' => 7,
                'photographer_id' => 1,
                'videographer_id' => null,
                'workhour_id' => 2,
                'namapaket' => 'Amerta',
                'kategori' => 'Engagement Package',
                'day' => '-',
                'flashdisk' => 0,
                'edited' => '50',
                'price' => 1500000,
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'idgaleri' => 8,
                'photographer_id' => 1,
                'videographer_id' => 1,
                'workhour_id' => 3,
                'namapaket' => 'Arunika',
                'kategori' => 'Engagement Package',
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
