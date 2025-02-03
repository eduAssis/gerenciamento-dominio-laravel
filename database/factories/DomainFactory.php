<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DomainFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $randomDate = fake()->dateTimeBetween('-5 years');

        return [
            'domain' => fake()->unique()->domainName(),
            'owner' => fake()->name(),
            'owner_email' => fake()->optional(70)->safeEmail(), // 70% de preenchimento
            'country' => fake()->optional()->countryCode(),
            'nserver' => fake()->optional()->domainWord() . '.ns.cloudflare.com',
            'status' => fake()->boolean(85), // 85% de true
            'provider' => fake()->randomElement(['Cloudflare', 'GoDaddy', 'Namecheap', 'HostGator', null]),
            'created_date' => $randomDate,
            'expires_date' => fake()->dateTimeBetween($randomDate, '+5 years'),
        ];
    }
}