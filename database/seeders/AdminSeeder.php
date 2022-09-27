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
            "name" => "Admin User",
            "username" => "myadmin",
            "email" => "myadmin@app.com",
            "phone" => "0818181818",
            'user_type' =>'admin',
            'status' => 'active',
            "password" => Hash::make("12345678"),
        ];

        DB::table("users")->updateOrInsert(
            ["name" => $superAdmin["name"], "username" => $superAdmin["username"], "email"  => $superAdmin["email"]],
            $superAdmin,
        );
        

    }
}
