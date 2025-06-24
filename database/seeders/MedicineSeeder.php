<?php

namespace Database\Seeders;

use App\Models\Medicines;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('medicines')->insert([
        //     [
        //         'name' => 'Paracetamol 500mg',
        //         'code' => 'MED001',
        //         'category' => 'Analgesic',
        //         'selling_price' => 5000.00,
        //         'purchase_price' => 3000.00,
        //         'stock' => 100,
        //         'packaging' => 'Box of 10 tablets',
        //         'expiration_date' => '2025-12-31',
        //         'drug_class' => 'Over-the-counter',
        //         'standard_name' => 'Paracetamol',
        //         'description' => 'Used to reduce fever and relieve pain.',
        //         'images' => 'paracetamol.jpg',
        //         'usage_instruction' => 'Take 1 tablet every 4-6 hours as needed.',
        //     ],
        //     [
        //         'name' => 'Amoxicillin 500mg',
        //         'code' => 'MED002',
        //         'category' => 'Antibiotic',
        //         'selling_price' => 12000.00,
        //         'purchase_price' => 8000.00,
        //         'stock' => 50,
        //         'packaging' => 'Strip of 10 capsules',
        //         'expiration_date' => '2026-06-30',
        //         'drug_class' => 'Prescription',
        //         'standard_name' => 'Amoxicillin',
        //         'description' => 'Antibiotic for bacterial infections.',
        //         'images' => 'amoxicillin.jpg',
        //         'usage_instruction' => 'Take 1 capsule every 8 hours for 7 days.',
        //     ],
        //     [
        //         'name' => 'Cetirizine 10mg',
        //         'code' => 'MED003',
        //         'category' => 'Antihistamine',
        //         'selling_price' => 7000.00,
        //         'purchase_price' => 4000.00,
        //         'stock' => 75,
        //         'packaging' => 'Box of 10 tablets',
        //         'expiration_date' => '2025-09-15',
        //         'drug_class' => 'Limited OTC',
        //         'standard_name' => 'Cetirizine',
        //         'description' => 'Relieves allergy symptoms.',
        //         'images' => 'cetirizine.jpg',
        //         'usage_instruction' => 'Take 1 tablet once daily.',
        //     ],
        // ]);

        $json = File::get(database_path('json/data_obat_apotek_transformed.json'));
        $items = json_decode($json);

        foreach ($items as $item) {
            Medicines::create([
                'name' => $item->name,
                'code' => $item->code,
                'category_id' => $item->category_id,
                'selling_price' => $item->selling_price,
                'stock' => $item->stock,
                'packaging_id' => $item->packaging_id,
                'drug_class' => $item->drug_class,
                'standard_name' => $item->standard_name,
                'description' => $item->description ?? '-',
                'images' => $item->images,
                'usage_instruction' => $item->usage_instruction,
            ]);
        }
    }
}
