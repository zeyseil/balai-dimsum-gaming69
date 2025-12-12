<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuItem::create([
            'name' => 'Nori',
            'image' => './img/Dimsumdisplay6.png',
            'price' => 12000,
            'category' => 'nori', 
        ]);

        MenuItem::create([
            'name' => 'Keju',
            'image' => './img/Dimsumdisplay3.png',
            'price' => 12000,
            'category' => 'keju', 
        ]);

        MenuItem::create([
            'name' => 'Mentai',
            'image' => './img/Dimsumdisplay1.png',
            'price' => 12000,
            'category' => 'mentai', 
        ]);

        MenuItem::create([
            'name' => 'Mix',
            'image' => './img/Dimsumdisplay2.png',
            'price' => 12000,
            'category' => 'mix', 
        ]);
    }
}
