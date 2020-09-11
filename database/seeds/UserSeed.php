<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'          => 'Nicolas',
            'email'         => 'nicodeg@gmail.com',
            'password'      => bcrypt('nicolas'),
            'role_id'       => 2
        ]);
    }
}
