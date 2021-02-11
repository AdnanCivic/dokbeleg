<?php

use Illuminate\Database\Seeder;
use App\Baustein;
use App\Gruppe;

class GruppesTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {

        $gruppe = Gruppe::create([ 'name' => 'Gruppe_1','user_id' => 1, 'anzahlBausteine' => 5]);

    }
}