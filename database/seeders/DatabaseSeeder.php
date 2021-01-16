<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use function Symfony\Component\String\s;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
//        $this->call(TenantsTableSeeder::class);
           $this->call(LevelsTablesSeeder::class);
           $this->call(UsersTableSeeder::class);
//        $this->call(NoteTableSeeder::class);
//        $this->call(CommentsTableSeeder::class);

    }
}
