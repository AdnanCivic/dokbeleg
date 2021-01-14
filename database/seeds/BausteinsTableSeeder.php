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
        Baustein::create(['name' => 'Erstes Hauptkapitel', 'typ' => 'hauptkapitel', 'heading' => 'Vorbemerkungen', 'content' => '<p>Allgemeine Erklärungen in den Vorbemerkungen.</p>']);
        Baustein::create(['name' => 'Zweites Hauptkapitel', 'typ' => 'hauptkapitel', 'heading'=> 'Die Lage bisher', 'content' => '']);
        Baustein::create(['name' => 'Erstes Oberkapitel', 'typ' => 'oberkapitel', 'heading' => 'Oberkapitel:Schritt 1', 'content' => '<p>Erste Einführung in die Phrenologie.</p>']);
        Baustein::create(['name' => 'Erstes Unterkapitel', 'typ' => 'unterkapitel', 'heading' => 'Unterkapitel:Schritt 1', 'content' => '<p>Lage der Phrenologie in Bayern.</p>']); 
    }
}
