<?php

use App\Baustein;
use Illuminate\Database\Seeder;

class BausteinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Baustein::truncate();
        Baustein::create(['name' => 'Deckblatt', 'typ' => 'deckblatt', 'heading' => 'Das ist das Deckblatt.','content' => '<p>Text des Deckblattes.</p>']);
        Baustein::create(['name' => 'Inhaltsverzeichnis', 'typ' => 'inhaltsverzeichnis', 'heading' => 'Inhaltsverzeichnis', 'content' => '<p>Gliederungspunkte.</p>']);
        Baustein::create(['name' => 'Vorbemerkungen', 'typ' => 'hauptkapitel', 'heading' => 'Vorbemerkungen', 'content' => '<p>Allgemeine Erklärungen in den Vorbemerkungen.</p>']);
    }
}
