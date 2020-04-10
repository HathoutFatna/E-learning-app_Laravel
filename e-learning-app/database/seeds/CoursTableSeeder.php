<?php

use App\Permission;
use Illuminate\Database\Seeder;
use App\Cour;
use App\Chapitre;

class CoursTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Cour::class, 5)->create()->each(function($Cour){
            $Cour->enseignants()->sync([2]);

            $Cour->Chapitres()->saveMany(factory(\App\Chapitre::class, 6)->create()->each(function($Chapitre){
                $Chapitre->lecons()->saveMany(factory(\App\Lecon::class, 6)->create());
            }));
        });

    }
}
