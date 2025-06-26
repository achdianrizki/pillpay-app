<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\SaleDetail;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sale::factory()
            ->count(50)
            ->create()
            ->each(function ($sale) {
                $detailsCount = rand(1, 5);
                for ($i = 0; $i < $detailsCount; $i++) {
                    $detail = SaleDetail::factory()->make();
                    $detail->sale_id = $sale->id;
                    $detail->save();
                }

                $sale->total_price = $sale->saleDetails()->sum('sub_total');
                $sale->save();
            });
    }
}
