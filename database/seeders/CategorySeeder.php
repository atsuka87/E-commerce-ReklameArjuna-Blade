<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Stempel',
                'slug' => 'stempel',
                'description' => 'Berbagai jenis stempel untuk keperluan kantor dan bisnis',
                'is_active' => true,
            ],
            [
                'name' => 'Plat Kendaraan Motor',
                'slug' => 'plat-kendaraan-motor',
                'description' => 'Plat nomor kendaraan motor custom sesuai keinginan',
                'is_active' => true,
            ],
            [
                'name' => 'Plat Kendaraan Mobil',
                'slug' => 'plat-kendaraan-mobil',
                'description' => 'Plat nomor kendaraan mobil custom dengan desain premium',
                'is_active' => true,
            ],
            [
                'name' => 'Pin Nama',
                'slug' => 'pin-nama',
                'description' => 'Pin nama custom untuk identitas dan keperluan formal',
                'is_active' => true,
            ],
            [
                'name' => 'Reklame Akrilik',
                'slug' => 'reklame-akrilik',
                'description' => 'Reklame akrilik berkualitas untuk promosi bisnis',
                'is_active' => true,
            ],
            [
                'name' => 'Pin Logo',
                'slug' => 'pin-logo',
                'description' => 'Pin logo custom untuk branding dan merchandise',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
