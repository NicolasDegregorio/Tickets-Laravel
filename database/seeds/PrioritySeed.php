<?php

use Illuminate\Database\Seeder;

class PrioritySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priorities')->insert([
            'name'          => 'Alta',
            
        ]);

        DB::table('priorities')->insert([
            'name'          => 'Media',
            
        ]);

        DB::table('priorities')->insert([
            'name'          => 'Baja',
            
        ]);
        
        
    }
}
