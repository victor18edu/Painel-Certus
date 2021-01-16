<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TenantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tenant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name,
            'cnpj_cpf' => $this->faker->randomNumber('5'),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->tollFreePhoneNumber,
        ];
    }
}
