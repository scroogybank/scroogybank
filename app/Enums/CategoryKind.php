<?php

namespace App\Enums;

enum CategoryKind: string
{
    case Expense = 'expense';
    case Income = 'income';
    case Transfer = 'transfer';
    case Receivables = 'receivables';
    case Payables = 'payables';
    case System = 'system';
}
