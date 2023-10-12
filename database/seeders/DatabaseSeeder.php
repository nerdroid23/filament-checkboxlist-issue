<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use App\Models\State;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'jdoe@mail.com'
        ]);

        $suppliers = Supplier::factory()
            ->count(3)
            ->create();

        foreach ($suppliers as $supplier) {
            $states = State::factory()
                ->count(random_int(1, 3))
                ->has(
                    City::factory()
                    ->count(random_int(5, 10))
                )
                ->create();

            $supplier->states()->attach($states);

            foreach ($states as $state) {
                $supplier->cities()->attach($state->cities);
            }
        }
    }
}
