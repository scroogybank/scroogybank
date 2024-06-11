<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Show the list of transactions.
     */
    public function index(): View
    {
        return view('transactions.list', [
            'transactions' => Transaction::orderBy('created_at')->paginate(100),
        ]);
    }
}
