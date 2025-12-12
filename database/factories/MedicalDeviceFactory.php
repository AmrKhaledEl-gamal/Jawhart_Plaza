<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\MedicalDevice;

class MedicalDeviceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MedicalDevice::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => '{}',
            'description' => '{}',
            'image' => fake()->word(),
        ];
    }
}
