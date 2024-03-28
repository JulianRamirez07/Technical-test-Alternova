<?php

namespace Database\Seeders;

use App\Models\Serie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Serie::create([
            'id' => 1,
            'title' => 'Breaking Bad',
            'description' => 'A high school chemistry teacher turned methamphetamine manufacturer partners with a former student to create and sell crystal meth',
            'start_year' => 2008,
            'end_year' => 2013
        ]);

        Serie::create([
            'id' => 2,
            'title' => 'Game of Thrones',
            'description' => 'Nine noble families fight for control over the lands of Westeros, while an ancient enemy returns after being dormant for millennia',
            'start_year' => 2011,
            'end_year' => 2019
        ]);
    }
}
