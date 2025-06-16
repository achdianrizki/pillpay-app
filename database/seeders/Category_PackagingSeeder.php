<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Packaging;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Category_PackagingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Analgesik', 'Antibiotik', 'Antihipertensi', 'Antihistamin', 'Antipiretik'];
        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }

        // Menyisipkan packaging menggunakan Eloquent
        $packagings = ['ampul', 'botol', 'box', 'strip', 'tube'];
        foreach ($packagings as $name) {
            Packaging::create(['name' => $name]);
        }
    }
}
