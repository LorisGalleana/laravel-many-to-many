<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProjectTechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 200; $i++){
            // estraggo un progetto random
            $project = Project::inRandomOrder()->first();

            //estraggo id di una tecnologia random
            $technology_id = Technology::inRandomOrder()->first()->id;

            // aggiungo la relazione fra il progetto estratto e l'id della tecnologia estratta
            $project->technologies()->attach($technology_id);
        }
    }
}
