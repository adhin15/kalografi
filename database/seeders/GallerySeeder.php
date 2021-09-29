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
        DB::table('images')->insert([
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916018/kalografi/placeholders/mahesa1_avyu6i.png',
                'image_one_public_id' => 'kalografi/placeholders/mahesa1_avyu6i',
                'image_two_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916015/kalografi/placeholders/mahesa2_wdkeyi.png',
                'image_two_public_id' => 'kalografi/placeholders/mahesa2_wdkeyi',
                'image_three_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916016/kalografi/placeholders/mahesa3_st8ekk.png',
                'image_three_public_id' => 'kalografi/placeholders/mahesa3_st8ekk',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916018/kalografi/placeholders/manendra1_d3rsft.png',
                'image_one_public_id' => 'kalografi/placeholders/manendra1_d3rsft',
                'image_two_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916019/kalografi/placeholders/manendra2_bwtgpo.png',
                'image_two_public_id' => 'kalografi/placeholders/manendra2_bwtgpo',
                'image_three_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916019/kalografi/placeholders/manendra3_m2vfj1.png',
                'image_three_public_id' => 'kalografi/placeholders/manendra3_m2vfj1',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916010/kalografi/placeholders/mahawira1_luxfr1.jpg',
                'image_one_public_id' => 'kalografi/placeholders/mahawira1_luxfr1',
                'image_two_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916011/kalografi/placeholders/mahawira2_iijnza.jpg',
                'image_two_public_id' => 'kalografi/placeholders/mahawira2_iijnza',
                'image_three_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916014/kalografi/placeholders/mahawira3_mxzqh2.jpg',
                'image_three_public_id' => 'kalografi/placeholders/mahawira3_mxzqh2',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916021/kalografi/placeholders/renjana1_vd2ezo.jpg',
                'image_one_public_id' => 'kalografi/placeholders/renjana1_vd2ezo',
                'image_two_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916022/kalografi/placeholders/renjana2_llx5nx.jpg',
                'image_two_public_id' => 'kalografi/placeholders/renjana2_llx5nx',
                'image_three_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916029/kalografi/placeholders/renjana3_chln9e.jpg',
                'image_three_public_id' => 'kalografi/placeholders/renjana3_chln9e',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916026/kalografi/placeholders/sekala1_y6u7nk.jpg',
                'image_one_public_id' => 'kalografi/placeholders/sekala1_y6u7nk',
                'image_two_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916024/kalografi/placeholders/sekala2_zayg0w.jpg',
                'image_two_public_id' => 'kalografi/placeholders/sekala2_zayg0w',
                'image_three_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916028/kalografi/placeholders/sekala3_oujac3.jpg',
                'image_three_public_id' => 'kalografi/placeholders/sekala3_oujac3',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916004/kalografi/placeholders/asmaraloka1_e6k0dk.jpg',
                'image_one_public_id' => 'kalografi/placeholders/asmaraloka1_e6k0dk',
                'image_two_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916005/kalografi/placeholders/asmaraloka2_pgaq1n.jpg',
                'image_two_public_id' => 'kalografi/placeholders/asmaraloka2_pgaq1n',
                'image_three_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916007/kalografi/placeholders/asmaraloka3_kflswc.jpg',
                'image_three_public_id' => 'kalografi/placeholders/asmaraloka3_kflswc',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632915997/kalografi/placeholders/amerta1_hgaitc.jpg',
                'image_one_public_id' => 'kalografi/placeholders/amerta1_hgaitc',
                'image_two_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632915998/kalografi/placeholders/amerta2_vgjjft.jpg',
                'image_two_public_id' => 'kalografi/placeholders/amerta2_vgjjft',
                'image_three_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632915999/kalografi/placeholders/amerta3_qat3wj.jpg',
                'image_three_public_id' => 'kalografi/placeholders/amerta3_qat3wj',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916006/kalografi/placeholders/arunika1_k2zjtb.jpg',
                'image_one_public_id' => 'kalografi/placeholders/arunika1_k2zjtb',
                'image_two_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916014/kalografi/placeholders/arunika2_kh80yg.jpg',
                'image_two_public_id' => 'kalografi/placeholders/arunika2_kh80yg',
                'image_three_secure_url' => 'https://res.cloudinary.com/ffajarpratama/image/upload/v1632916002/kalografi/placeholders/arunika3_etcuzw.jpg',
                'image_three_public_id' => 'kalografi/placeholders/arunika3_etcuzw',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
        ]);
    }
}
