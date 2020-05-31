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
        Baustein::create(['name' => 'Deckblatt', 'html' => '<p>Das ist ein Baustein.</p>']);
        Baustein::create(['name' => 'Inhaltsverzeichnis', 'html' => '<p>Das ist das Inhaltsverzeichnis.</p>']);
        Baustein::create(['name' => 'Vorbemerkungen', 'html' => '<p>Das sind die Vorbemerkungen.</p>']);
    }
}
