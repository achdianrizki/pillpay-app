<?php

namespace Database\Factories;

use App\Models\SaleDetail;
use App\Models\Medicines;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleDetail>
 */
class SaleDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SaleDetail::class;

    public function definition(): array
    {
        $medicine = Medicines::inRandomOrder()->first();
        $quantity = $this->faker->numberBetween(1, 5);
        $unitPrice = $medicine->selling_price ?? $this->faker->randomFloat(2, 5000, 100000);
        $subTotal = $quantity * $unitPrice;
        $change = $this->faker->randomFloat(2, 0, 500);
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');

        return [
            'medicine_id' => $medicine->id,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'sub_total' => $subTotal,
            'change' => $change,
            'created_at' => $createdAt,
        ];
    }
}
