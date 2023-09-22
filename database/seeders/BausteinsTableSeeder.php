<?php

namespace Database\Seeders;

use App\Models\Baustein;
use Illuminate\Database\Seeder;

class BausteinsTableSeeder extends Seeder
{
    public function run()
    {
        Baustein::truncate();
        Baustein::create(['user_id' => 1, 'name' => 'Deckblatt', 'typ' => 'deckblatt', 'heading' => 'Das ist das Deckblatt.','content' => '<p>Text des Deckblattes.</p>']);
        Baustein::create(['user_id' => 1, 'name' => 'Erstes Hauptkapitel', 'typ' => 'hauptkapitel', 'heading' => 'Vorbemerkungen', 'content' => '<p>Allgemeine Erklärungen in den Vorbemerkungen.</p>']);
        Baustein::create(['user_id' => 1, 'name' => 'Zweites Hauptkapitel', 'typ' => 'hauptkapitel', 'heading'=> 'Die Lage bisher', 'content' => '']);
        Baustein::create(['user_id' => 1, 'name' => 'Erstes Oberkapitel', 'typ' => 'oberkapitel', 'heading' => 'Oberkapitel:Schritt 1', 'content' => '<p>Erste Einführung in die Phrenologie.</p>']);
        Baustein::create(['user_id' => 1, 'name' => 'Erstes Unterkapitel', 'typ' => 'unterkapitel', 'heading' => 'Unterkapitel:Schritt 1', 'content' => '<p><h3>Einleitung</h3></p><p>Lage der Phrenologie in Bayern.</p>']);
        Baustein::create(['user_id' => 1, 'name' => 'Zweites Unterkapitel', 'typ' => 'unterkapitel', 'heading' => 'Unterkapitel:Schritt 2', 'content' => '<p>Lage der Phrenologie in Bayern.</p>.']);

    }
}
