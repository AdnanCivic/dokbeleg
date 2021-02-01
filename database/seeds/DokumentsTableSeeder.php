<?php

use App\Baustein;
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
        Dokument::truncate();
        DB::table('baustein_dokument')->truncate();

        $deckblatt = Baustein::where('name', 'Deckblatt')->first();
        $hauptkapitel_1 = Baustein::where('name', 'Erstes Hauptkapitel')->first();
        $hauptkapitel_2 = Baustein::where('name', 'Zweites Hauptkapitel')->first();
        $oberkapitel = Baustein::where('name', 'Erstes Oberkapitel')->first();
        $unterkapitel = Baustein::where('name', 'Erstes Unterkapitel')->first(); 

        $dokument = Dokument::create(['name' => 'Verfahrens- und Belegdokumentation','user_id' => 1, 'anzahlBausteine' => 5]);

        $dokument->bausteins()->attach([
            $deckblatt->id, 
            $hauptkapitel_1->id, 
            $hauptkapitel_2->id, 
            $oberkapitel->id, 
            $unterkapitel->id
        ]);
    }
}
