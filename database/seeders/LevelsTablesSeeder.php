<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Seeder;

class LevelsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Level::create([

            'name' => 'Usuário',

        ]);
        Level::create([

            'name' => 'Administrade de empresa',
                   ]);
        Level::create([

            'name' => 'Administrador do sistema',

        ]);
        Level::create([

            'name' => 'Super administrador',
        ]);
    }
}
