<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = User::factory()->make([
            'name' => 'Paolo Sabaleta',
            'username' => 's.paolo',
            'password' => 'S4b4l3t4!',
            'role' => 'manager',
        ]);

        $manager->save();

        $agent = User::factory()->make([
            'name' => 'Dario Platenza',
            'username' => 'p.dario',
            'password' => 'S4b4l3t4#',
            'role' => 'agent',
        ]);

        $agent->save();
    }
}
