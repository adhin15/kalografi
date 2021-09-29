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
                'image_one_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935449/kalografi/placeholders/mahesa1_ioihuk.png',
                'image_one_public_id' => 'kalografi/placeholders/mahesa1_ioihuk',
                'image_two_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935449/kalografi/placeholders/mahesa2_l0evye.png',
                'image_two_public_id' => 'kalografi/placeholders/mahesa2_l0evye',
                'image_three_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935451/kalografi/placeholders/mahesa3_edlhyw.png',
                'image_three_public_id' => 'kalografi/placeholders/mahesa3_edlhyw',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935459/kalografi/placeholders/manendra1_ymel2s.png',
                'image_one_public_id' => 'kalografi/placeholders/manendra1_ymel2s',
                'image_two_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935460/kalografi/placeholders/manendra2_mukdfl.png',
                'image_two_public_id' => 'kalografi/placeholders/manendra2_mukdfl',
                'image_three_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935450/kalografi/placeholders/manendra3_kk9doh.png',
                'image_three_public_id' => 'kalografi/placeholders/manendra3_kk9doh',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935446/kalografi/placeholders/mahawira1_twivfu.jpg',
                'image_one_public_id' => 'kalografi/placeholders/mahawira1_twivfu',
                'image_two_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935448/kalografi/placeholders/mahawira2_s1oxih.jpg',
                'image_two_public_id' => 'kalografi/placeholders/mahawira2_s1oxih',
                'image_three_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935447/kalografi/placeholders/mahawira3_q1n2ub.jpg',
                'image_three_public_id' => 'kalografi/placeholders/mahawira3_q1n2ub',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935452/kalografi/placeholders/renjana1_ep7lit.jpg',
                'image_one_public_id' => 'kalografi/placeholders/renjana1_ep7lit',
                'image_two_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935453/kalografi/placeholders/renjana2_vi3jpr.jpg',
                'image_two_public_id' => 'kalografi/placeholders/renjana2_vi3jpr',
                'image_three_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935455/kalografi/placeholders/renjana3_dpxkee.jpg',
                'image_three_public_id' => 'kalografi/placeholders/renjana3_dpxkee',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935459/kalografi/placeholders/sekala1_r9fhtl.jpg',
                'image_one_public_id' => 'kalografi/placeholders/sekala1_r9fhtl',
                'image_two_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935457/kalografi/placeholders/sekala2_n0qr4a.jpg',
                'image_two_public_id' => 'kalografi/placeholders/sekala2_n0qr4a',
                'image_three_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935458/kalografi/placeholders/sekala3_jt5x5o.jpg',
                'image_three_public_id' => 'kalografi/placeholders/sekala3_jt5x5o',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935444/kalografi/placeholders/asmaraloka1_iay10i.jpg',
                'image_one_public_id' => 'kalografi/placeholders/asmaraloka1_iay10i',
                'image_two_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935446/kalografi/placeholders/asmaraloka2_stuphi.jpg',
                'image_two_public_id' => 'kalografi/placeholders/asmaraloka2_stuphi',
                'image_three_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935445/kalografi/placeholders/asmaraloka3_w0nopa.jpg',
                'image_three_public_id' => 'kalografi/placeholders/asmaraloka3_w0nopa',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935437/kalografi/placeholders/amerta1_uix2np.jpg',
                'image_one_public_id' => 'kalografi/placeholders/amerta1_uix2np',
                'image_two_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935438/kalografi/placeholders/amerta2_npoi0g.jpg',
                'image_two_public_id' => 'kalografi/placeholders/amerta2_npoi0g',
                'image_three_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935440/kalografi/placeholders/amerta3_bynpef.jpg',
                'image_three_public_id' => 'kalografi/placeholders/amerta3_bynpef',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
            [
                'image_one_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935440/kalografi/placeholders/arunika1_dltoex.jpg',
                'image_one_public_id' => 'kalografi/placeholders/arunika1_dltoex',
                'image_two_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935440/kalografi/placeholders/arunika2_xtgqls.jpg',
                'image_two_public_id' => 'kalografi/placeholders/arunika2_xtgqls',
                'image_three_secure_url' => 'https://res.cloudinary.com/kalografi/image/upload/v1632935440/kalografi/placeholders/arunika3_aoasuf.jpg',
                'image_three_public_id' => 'kalografi/placeholders/arunika3_aoasuf',
                'created_at' => date($today),
                'updated_at' => date($today)
            ],
        ]);
    }
}
