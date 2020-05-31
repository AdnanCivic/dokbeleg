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
        Dokumentation::create(['name' => 'Verfahrens- und Belegdokumentation']);

        $deckblattBaustein = Baustein::where('name', 'Deckblatt')->first();
        $inhaltsverzeichnisBaustein = Baustein::where('name', 'Inhaltsverzeichnis')->first();
        $vorbemerkungenBaustein = Baustein::where('name', 'Vorbemerkungen')->first();
    }
}
