<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => '2023-04-16 21:10:07',
            'created_at' => '2023-04-16 21:10:07',
            'updated_at' => '2023-04-16 21:10:07',
            'remember_token' => 'xx',
            'password' => '$2y$10$tmSCp8H/0wHSJ.0Ui62CHezk8yJYVigsPlAmE2pMN2Cg7f9iIeQui',
            'admin' => 1,
        ]);
    }
}
