<?php

use App\User;
use App\Dokument;
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
            'password' => Hash::make('defaultuser')
        ]);

    }
}
