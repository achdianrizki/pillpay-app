<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Sale::class;

    public function definition(): array
    {
        $totalPrice = $this->faker->randomFloat(2, 10000, 500000);
        $paymentMethod = $this->faker->randomElement(['cash', 'qris']);
        $change = $this->faker->randomFloat(2, 0, 10000);
        $createdAt = $this->faker->dateTimeBetween(date('Y') . '-01-01', 'now');

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'total_price' => $totalPrice,
            'payment_method' => $paymentMethod,
            'change' => $change,
            'created_at' => $createdAt,
            'updated_at' => $createdAt, // optional: supaya updated_at juga sama tanggal
        ];
    }
}
