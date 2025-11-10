<?php

namespace Helpz\Report\Database\Factories;

use Carbon\Carbon;
use Helpz\Device\Models\Device;
use Helpz\ServiceRequest\Models\ServiceRequest;
use Helpz\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Helpz\Report\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(4,5),
            'user_id' => User::factory()->create()->getKey(),
            'service_request_id' => ServiceRequest::factory()->create()->getKey(),
            'device_id' => Device::factory()->create()->getKey(),
            'created_at' => Carbon::now(),
        ];
    }
}
