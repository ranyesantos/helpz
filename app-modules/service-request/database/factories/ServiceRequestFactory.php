<?php

namespace Helpz\ServiceRequest\Database\Factories;

use App\Models\User;
use Helpz\Device\Models\Device;
use Helpz\ServiceRequest\Models\ServiceRequest;
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
            'status' => $this->faker->randomElement(['pending', 'done', 'canceled', 'in_progress']),
        ];
    }

    public function generateServiceRequests(Collection $users, Collection $devices): void
    {
        for ($i = 0; $i < rand(12, 28); $i++) {
            ServiceRequest::factory()
                ->forUser($users->random())
                ->forDevice($devices->random())
                ->create();
        }
    }

    private function forUser(User $user): self
    {
        return $this->state(fn () => [
            'user_id' => $user->id
        ]);
    }

    private function forDevice(Device $device): self
    {
        return $this->state(fn () => [
            'device_id' => $device->id
        ]);
    }
}
