<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pr_name' => substr($this->faker->word, 0, 10), // اسم المنتج لا يتجاوز 10 أحرف
            'pr_name_en' => substr($this->faker->word, 0, 10), // اسم المنتج بالإنجليزية لا يتجاوز 10 أحرف
            'pr_image' => '01JJCCFEQN3HEMD4EQCKT3BZQK.png', // صورة ثابتة
            'pr_cost' => $this->faker->numberBetween(100, 1000), // تكلفة المنتج
            'pr_cost_new' => $this->faker->numberBetween(50, 900), // تكلفة جديدة
            'pr_detail' => $this->faker->sentence(10), // وصف المنتج
            'pr_detail_en' => $this->faker->sentence(10), // وصف المنتج بالإنجليزية
            'pr_discoutn' => $this->faker->numberBetween(0, 50), // خصم المنتج
            'cat_fk' => $this->faker->numberBetween(4, 6), // رقم عشوائي من 1 إلى 5
        ];
    }
}
