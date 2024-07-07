<?php

namespace Database\Seeders;

use App\Models\Vehicletypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class vehicletypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $t1 = new Vehicletypes();
        $t1->name = 'Carga lateral';
        $t1->save();

        $t2 = new Vehicletypes();
        $t2->name = 'Carga trasera';
        $t2->save();

        $t3 = new Vehicletypes();
        $t3->name = 'Carga trasera con grúa';
        $t3->save();
    }
}
