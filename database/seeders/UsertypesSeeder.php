<?php

namespace Database\Seeders;

use App\Models\Usertype;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsertypesSeeder extends Seeder
{

    public function run(): void
    {
        Usertype::create([
            'name' => 'Administrador',
            'description' => 'Administrador del sistema',
        ]);
        Usertype::create([
            'name' => 'Conductor',
            'description' => 'Cliente del sistema',
        ]);
        Usertype::create([
            'name' => 'Reciclador',
            'description' => 'Reciclador del sistema',
        ]);
        Usertype::create([
            'name' => 'Cliente',
            'description' => 'Cliente del sistema',
        ]);
    }
}
