<?php

use App\Baustein;
use App\Dokumentation;
use Illuminate\Database\Seeder;

class DokumentationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dokumentation::truncate();
        DB::table('baustein_dokumentation')->truncate();

        $deckblattBaustein = Baustein::where('name', 'Deckblatt')->first();
        $inhaltsverzeichnisBaustein = Baustein::where('name', 'Inhaltsverzeichnis')->first();
        $vorbemerkungenBaustein = Baustein::where('name', 'Vorbemerkungen')->first();

        $dokumentation = Dokumentation::create(['name' => 'Verfahrens- und Belegdokumentation', 'user_id' => 1, 'anzahlBausteine' => 3]);

        $dokumentation->bausteins()->attach([
            $deckblattBaustein->id, $inhaltsverzeichnisBaustein->id, $vorbemerkungenBaustein->id
        ]);
    }
}
