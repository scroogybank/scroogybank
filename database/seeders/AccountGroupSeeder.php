<?php

namespace Database\Seeders;

use App\Models\AccountGroup;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccountGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccountGroup::factory(10)
            ->recycle(User::factory()->create())
            ->create();
    }
}
