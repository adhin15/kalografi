<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'password';
        $today = Carbon::today();
        DB::table('users')->insert([
            [
                'name' => 'Fajar Pratama',
                'email' => 'fajar@mail.com',
                'email_verified_at' => null,
                'password' => Hash::make($password),
                'remember_token' => null,
                'created_at' => date($today),
                'updated_at' => date($today)
            ]
        ]);
    }
}
