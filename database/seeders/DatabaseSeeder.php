<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Listing;
use App\Models\Niveau;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();

        $niv = Niveau::factory()->create([
            'title' => '2CI ISI',
        ]);

        $user = User::factory()->create([
            'name' => 'Admin Ad',
            'email' => 'admin@test.com',
            'niveau_id' => 1,
            'role' => "Admin",
            'password' => bcrypt('password')
        ]);
        $user = User::factory()->create([
            'name' => 'Etudiant Ad',
            'email' => 'student@test.com',
            'niveau_id' => 1,
            'role' => "Etudiant",
            'password' => bcrypt('password')
        ]);
        $user = User::factory()->create([
            'name' => 'Professor Ad',
            'email' => 'prof@test.com',
            'niveau_id' => 1,
            'role' => "Professor",
            'password' => bcrypt('password')
        ]);

 
    }
}
