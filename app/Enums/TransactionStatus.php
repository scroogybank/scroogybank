<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case Cleared = 'cleared';
    case Reconciled = 'reconciled';
}
