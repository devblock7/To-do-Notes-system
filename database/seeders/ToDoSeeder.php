<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ToDoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('to_dos')->insert( [
        [
            'description'=> 'Built based on client specification.',
            'completed'=> true,
        ],
        [
            'description'=> 'Cross Browser checks to ensure consistancy of design (IE, Edge, FF, Chrome)',
            'completed'=> true,
        ],
        [
            'description'=> 'Vue.js implementation',
            'completed'=> true,
        ],    
        [
            'description'=> 'Create users registration and login system',
            'completed'=> false,
        ],
       ]
    );
    }
}
