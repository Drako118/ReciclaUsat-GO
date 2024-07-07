<?php

namespace Database\Seeders;

use App\Models\Routestatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoutestatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Routestatus::create(['name' => 'Programado']);
        Routestatus::create(['name' => 'En Curso']);
        Routestatus::create(['name' => 'Averiado']);
        Routestatus::create(['name' => 'Cancelado']);
        Routestatus::create(['name' => 'Finalizado']);
    }
}
