<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dokument;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Adnan Civic',
            'email' => 'acivic@user.com',
            'password' => Hash::make('Obergrattler')
        ]);

        $demouser = User::create([
            'name' => 'demouser',
            'email' => 'demouser@mail.de',
            'password' => Hash::make('DemoAccount#1')
        ]);

        for($i = 1; $i <= 5; $i++){
            User::create([
                'name' => "testuser".(string)$i,
                'email' => "testuser".(string)$i."@user.com",
                'password' => Hash::make('testuser'.(string)$i.'!')
            ]);
        }

    }
}
