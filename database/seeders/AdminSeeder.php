<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin=[
            "first_name" => "Admin",
            "last_name" => "myadmin",
            "email" => "myadmin@app.com",
            "phone" => "0818181818",
            'user_type' =>'admin',
            'status' => 'active',
            "password" => Hash::make("12345678"),
        ];

        DB::table("users")->updateOrInsert(
            ["first_name" => $superAdmin["first_name"], "last_name" => $superAdmin["last_name"], "email"  => $superAdmin["email"]],
            $superAdmin,
        );
        

    }
}
