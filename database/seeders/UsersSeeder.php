<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
/*         User::create([
            'name' => 'Administrador',
            'lastname' => 'Administrador',
            'dni' => '12345678',
            'email' => 'cisique@cisique.com',
            'password' => Hash::make('redhat123.'),
            'usertype_id' => 1,
        ]); */
        User::create([
            'name' => 'Administrador',
            'lastname' => 'Administrador',
            'dni' => '12254578',
            'email' => 'guivar@guivar.com',
            'password' => Hash::make('guivar123.'),
            'usertype_id' => 1,
        ]);
        User::create([
            'name' => 'Administrador',
            'lastname' => 'Administrador',
            'dni' => '12254577',
            'email' => 'chozo@chozo.com',
            'password' => Hash::make('chozo123.'),
            'usertype_id' => 1,
        ]);
        User::create([
            'name' => 'Administrador',
            'lastname' => 'Administrador',
            'dni' => '12252278',
            'email' => 'janny@janny.com',
            'password' => Hash::make('janny123.'),
            'usertype_id' => 1,
        ]);
    }
}
