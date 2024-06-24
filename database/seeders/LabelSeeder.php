<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\User;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Label::factory(10)
            ->recycle(User::factory()->create())
            ->create();
    }
}
