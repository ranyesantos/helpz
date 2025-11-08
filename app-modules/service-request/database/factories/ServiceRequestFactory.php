<?php

namespace Helpz\ServiceRequest\Database\Factories;

use Helpz\Device\Models\Device;
use Helpz\ServiceRequest\Enums\ServiceRequestStatusEnum;
use Helpz\ServiceRequest\Models\ServiceRequest;
use Helpz\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Helpz\ServiceRequest\Models\ServiceRequest>
 */
class ServiceRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ServiceRequest::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'user_id' => User::factory(),
            'device_id' => Device::factory(),
            'status' => $this->faker->randomElement([
                ServiceRequestStatusEnum::Pending->value, 
                ServiceRequestStatusEnum::Done->value,
                ServiceRequestStatusEnum::Canceled->value,
                ServiceRequestStatusEnum::In_Progress->value
            ]),
        ];
    }
}
