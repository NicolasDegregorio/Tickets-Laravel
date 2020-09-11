<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'          => 'user',
            'description'   => "Usuario"
            
        ]);
        DB::table('roles')->insert([
            'name'          => 'admin',
            'description'   => "Administrador"
            
        ]);
    }
}
