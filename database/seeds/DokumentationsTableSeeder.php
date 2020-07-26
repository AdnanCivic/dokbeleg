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

        $deckblattBaustein = Baustein::where('nummer', 'vbd-00')->first();
        $inhaltsverzeichnisBaustein = Baustein::where('nummer', 'vbd-01')->first();
        $vorbemerkungenBaustein = Baustein::where('nummer', 'vbd-02')->first();

        $dokumentation = Dokumentation::create(['name' => 'Verfahrens- und Belegdokumentation', 'user_id' => 1]);

        $dokumentation->bausteins()->attach([
            $deckblattBaustein->id, $inhaltsverzeichnisBaustein->id, $vorbemerkungenBaustein->id
        ]);
    }
}
