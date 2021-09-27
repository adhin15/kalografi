<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PhotographerSeeder::class,
            VideographerSeeder::class,
            WorkhourSeeder::class,
            GallerySeeder::class,
            AdditionalSeeder::class,
            PackageSeeder::class,
            DiscountSeeder::class,
            PhotobookSeeder::class,
            PrintedPhotoSeeder::class
        ]);
    }
}
