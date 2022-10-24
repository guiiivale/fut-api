<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'before',
            'email' => 'before@before.com',
            'password' => Hash::make('qK)gNBz5)3}WxSm?'),
            'token' => base64_encode('before@before.com:qK)gNBz5)3}WxSm?')
        ]);

    }
}
