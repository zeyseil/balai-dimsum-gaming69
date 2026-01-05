<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'nama_menu' => 'Nori',
            'foto_menu' => 'img/Dimsumdisplay6.png',
            'harga_reguler' => 15000,
            'harga_mini' => 12000,
            'kategori' => 'reguler',
            'stock' =>  15
        ]);
    }
}
