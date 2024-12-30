<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpvotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $featureIds = DB::table('features')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();

        if (empty($featureIds) || empty($userIds)) {
            $this->command->info('No features or users available to seed upvotes.');
            return;
        }

        foreach (range(1, 50) as $index) {
            DB::table('upvotes')->insert([
                'feature_id' => $faker->randomElement($featureIds),
                'user_id' => $faker->randomElement($userIds),
                'upvote' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Upvotes table seeded successfully!');

    }
}
