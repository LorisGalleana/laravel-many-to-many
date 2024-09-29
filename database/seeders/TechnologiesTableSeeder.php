<?php

namespace Database\Seeders;

use App\Functions\Helper;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Frond End', 'Back End', 'Design', 'UX', 'Laravel', 'VueJs', 'Angular', 'React'];

        foreach ($data as $technology) {
            $new_technology = new Technology();
            $new_technology->name = $technology;
            $new_technology->slug = Helper::generateSlug($new_technology->name, Technology::class);
            $new_technology->save();
        }
    }
}
