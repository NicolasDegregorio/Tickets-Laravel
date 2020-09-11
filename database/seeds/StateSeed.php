<?php

use Illuminate\Database\Seeder;

class StateSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'name'          => 'Sin Resolver',
            
        ]);
        DB::table('states')->insert([
            'name'          => 'En Progreso',
            
        ]);
        DB::table('states')->insert([
            'name'          => 'Completado',
            
        ]);
    }
}
