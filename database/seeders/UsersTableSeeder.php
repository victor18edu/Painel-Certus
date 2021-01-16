<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        User::create([
            'name' => 'nivel3',
            'email' => 'nivel4@gmail.com',
            'level_id' => '4',
          //  'tenant_id' => '1',
            'password' => bcrypt(123)
        ]);
           // $users = User::factory()->count(25)->create();
    }
}
