<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['test','test@gmail.com', '12345678','Quảng trị', '0886778246'],
        ];

        foreach($users as $user){
            User::create([
                'name' => $user[0],
                'email' => $user[1],
                'password' => Hash::make($user[2]),
                'address' => $user[3],
                'phone' => $user[4],
            ]);
        }
    }
}
