<?php

use App\User;
use App\Dokumentation;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('baustein_dokumentation')->truncate();

        $vbDoku = Dokumentation::where('name', 'Verfahrens- und Belegdokumentation')->first();
        
        User::create();
    }
}
