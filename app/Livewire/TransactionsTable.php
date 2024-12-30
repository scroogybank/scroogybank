<?php

namespace App\Livewire;

use App\Models\Transaction;
use App\Table\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * @use Table<Transaction>
 */
class TransactionsTable extends Table
{
    public function model(): Transaction
    {
        return app(Transaction::class);
    }

    public function query(): Builder
    {
        return Auth::user()->transactions()->getQuery();
    }

    public function columns(): array
    {
        return [
            Column::make('name', __('transaction.name')),
            Column::make('amount', __('transaction.amount')),
            Column::make('note', __('transaction.note')),
            Column::make('created_at', __('transaction.created_at')),
        ];
    }
}
