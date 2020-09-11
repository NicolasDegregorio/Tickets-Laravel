<?php

use Illuminate\Database\Seeder;

class InstitutionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutions')->insert([
            'name'          => 'Escuela N° 501',
            'adress'        => 'Joaquin de los Santos 1550',
            'cue'           => '3400148'
        ]);
    }
}
