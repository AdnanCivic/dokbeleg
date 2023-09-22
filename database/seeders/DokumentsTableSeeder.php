<?php

use App\Gruppe;
use App\Dokument;
use Illuminate\Database\Seeder;

class DokumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $gruppe = DB::table('gruppes')->first();

        $dokument = Dokument::create(['name' => 'Verfahrensdokumentation','user_id' => 1, 'anzahlGruppen' => 1]);

        $dokument->gruppes()->attach([1]);
    }
}
