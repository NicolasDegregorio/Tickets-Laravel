<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(PrioritySeed::class);
         $this->call(StateSeed::class);
         $this->call(RoleSeed::class);
         $this->call(InstitutionSeed::class);
         $this->call(UserSeed::class);
    }
}
