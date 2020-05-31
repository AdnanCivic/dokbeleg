<?php

use BausteinsTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BausteinsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(DokumentationsTableSeeder::class);
    }
}
