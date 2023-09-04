<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
      $this->call([
          RoleSeeder::class,
          UserSeeder::class,
          SettingSeeder::class,
          CategorySeeder::class,
          HelpCenterSeeder::class,
          PageSeeder::class,
          MenuSeeder::class,
          AttributeSeeder::class,
          ProductSeeder::class
      ]);
    }
}
