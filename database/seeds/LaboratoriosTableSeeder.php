<?php

use Illuminate\Database\Seeder;

class LaboratoriosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Laboratorio::class, 12)->create();
    }
}
