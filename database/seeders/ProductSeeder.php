<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');

        $products = [
            [
                'name' => 'Stempel Bulat Standar',
                'slug' => 'stempel-bulat-standar',
                'category_id' => $categories['stempel'],
                'description' => 'Stempel bulat berkualitas tinggi, cocok untuk keperluan kantor dan bisnis. Bisa custom dengan teks dan logo sesuai kebutuhan.',
                'base_price' => 45000,
                'stock' => 50,
                'is_active' => true,
                'allow_custom' => true,
                'custom_options' => ['custom_text', 'custom_size', 'custom_color'],
            ],
            [
                'name' => 'Stempel Kotak Professional',
                'slug' => 'stempel-kotak-professional',
                'category_id' => $categories['stempel'],
                'description' => 'Stempel kotak dengan desain professional, ideal untuk dokumen resmi dan keperluan formal.',
                'base_price' => 55000,
                'stock' => 30,
                'is_active' => true,
                'allow_custom' => true,
                'custom_options' => ['custom_text', 'custom_size', 'custom_color'],
            ],
            [
                'name' => 'Plat Motor Custom Basic',
                'slug' => 'plat-motor-custom-basic',
                'category_id' => $categories['plat-kendaraan-motor'],
                'description' => 'Plat nomor motor custom dengan material berkualitas, desain minimalis dan modern.',
                'base_price' => 120000,
                'stock' => 25,
                'is_active' => true,
                'allow_custom' => true,
                'custom_options' => ['custom_text', 'custom_size', 'custom_color'],
            ],
            [
                'name' => 'Plat Motor Premium',
                'slug' => 'plat-motor-premium',
                'category_id' => $categories['plat-kendaraan-motor'],
                'description' => 'Plat nomor motor premium dengan finishing krom dan desain elegan.',
                'base_price' => 180000,
                'stock' => 15,
                'is_active' => true,
                'allow_custom' => true,
                'custom_options' => ['custom_text', 'custom_size', 'custom_color'],
            ],
            [
                'name' => 'Plat Mobil Executive',
                'slug' => 'plat-mobil-executive',
                'category_id' => $categories['plat-kendaraan-mobil'],
                'description' => 'Plat nomor mobil executive dengan material premium dan desain mewah.',
                'base_price' => 250000,
                'stock' => 10,
                'is_active' => true,
                'allow_custom' => true,
                'custom_options' => ['custom_text', 'custom_size', 'custom_color'],
            ],
            [
                'name' => 'Pin Nama Metal',
                'slug' => 'pin-nama-metal',
                'category_id' => $categories['pin-nama'],
                'description' => 'Pin nama dengan material metal, elegan dan tahan lama. Cocok untuk identitas karyawan.',
                'base_price' => 35000,
                'stock' => 100,
                'is_active' => true,
                'allow_custom' => true,
                'custom_options' => ['custom_text', 'custom_size', 'custom_color'],
            ],
            [
                'name' => 'Pin Nama Gold',
                'slug' => 'pin-nama-gold',
                'category_id' => $categories['pin-nama'],
                'description' => 'Pin nama dengan finishing gold, memberikan kesan premium dan professional.',
                'base_price' => 45000,
                'stock' => 75,
                'is_active' => true,
                'allow_custom' => true,
                'custom_options' => ['custom_text', 'custom_size', 'custom_color'],
            ],
            [
                'name' => 'Reklame Akrilik Small',
                'slug' => 'reklame-akrilik-small',
                'category_id' => $categories['reklame-akrilik'],
                'description' => 'Reklame akrilik ukuran kecil, ideal untuk promosi indoor dan branding kecil.',
                'base_price' => 150000,
                'stock' => 20,
                'is_active' => true,
                'allow_custom' => true,
                'custom_options' => ['custom_text', 'custom_size', 'custom_color', 'upload_logo'],
            ],
            [
                'name' => 'Reklame Akrilik Large',
                'slug' => 'reklame-akrilik-large',
                'category_id' => $categories['reklame-akrilik'],
                'description' => 'Reklame akrilik ukuran besar, cocok untuk promosi outdoor dan branding perusahaan.',
                'base_price' => 350000,
                'stock' => 10,
                'is_active' => true,
                'allow_custom' => true,
                'custom_options' => ['custom_text', 'custom_size', 'custom_color', 'upload_logo'],
            ],
            [
                'name' => 'Pin Logo Round',
                'slug' => 'pin-logo-round',
                'category_id' => $categories['pin-logo'],
                'description' => 'Pin logo bentuk bulat, cocok untuk merchandise dan branding event.',
                'base_price' => 25000,
                'stock' => 200,
                'is_active' => true,
                'allow_custom' => true,
                'custom_options' => ['upload_logo', 'custom_size', 'custom_color'],
            ],
            [
                'name' => 'Pin Logo Custom Shape',
                'slug' => 'pin-logo-custom-shape',
                'category_id' => $categories['pin-logo'],
                'description' => 'Pin logo dengan bentuk custom sesuai desain logo Anda.',
                'base_price' => 40000,
                'stock' => 50,
                'is_active' => true,
                'allow_custom' => true,
                'custom_options' => ['upload_logo', 'custom_size', 'custom_color'],
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
