<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Akun extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name'=>'Fajri',
                'email'=>'admin@gmail.com',
                'password'=> bcrypt('password'),
                'role'=> 1
            ],
            [
                'name'=>'Petugas',
                'email'=>'petugas@gmail.com',
                'password'=> bcrypt('password'),
                'role'=> 2
            ],
            [
                'name'=>'Siswa',
                'email'=>'siswa@gmail.com',
                'password'=> bcrypt('password'),
                'role'=> 3
            ],

        ];
        foreach($data as $key => $d) {
            User::create($d);
        }
    }
}
