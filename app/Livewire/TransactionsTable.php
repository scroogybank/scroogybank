<?php

namespace App\Livewire;

use App\Models\Transaction;
use App\Table\Column;
use Illuminate\Database\Eloquent\Builder;

class TransactionsTable extends Table
{

    public function query(): Builder
    {
        return Transaction::query()->where('user_ulid', auth()->id());
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
