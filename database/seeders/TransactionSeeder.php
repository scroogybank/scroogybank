<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Symfony\Component\Uid\Ulid;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 normal transactions
        Transaction::factory(10)
            ->recycle(User::factory()->create())
            ->hasLabels(fake()->numberBetween(0, 5))
            ->create();

        // Create 5 transfers
        Transaction::factory(5)
            ->recycle(User::factory()->create())
            ->hasLabels(fake()->numberBetween(0, 5))
            ->hasTransferFrom(1, function (array $attributes, Transaction $transaction) {
                return ['amount' => $transaction->amount->multiply(-1)];
            })
            ->create();

        Transaction::where('transfer_from_ulid', '!=', null)
            ->get()
            ->each(
                function (Transaction $transaction) {
                    Transaction::find($transaction->transfer_from_ulid)->update(['transfer_from_ulid' => $transaction->ulid]);
                }
            );

        // Create 2 collections, 4 with one ulid and 4 with another
        Transaction::factory(8)
            ->sequence(
                ['collection_ulid' => new Ulid()],
                ['collection_ulid' => new Ulid()],
            )
            ->recycle(User::factory()->create())
            ->hasLabels(fake()->numberBetween(0, 5))
            ->create();
    }
}
