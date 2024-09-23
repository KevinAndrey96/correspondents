<?php

namespace App\Enums\Transactions;

enum TransactionTypeEnum: string
{
    case DEPOSIT = 'Deposit';
    case WITHDRAWAL = 'Withdrawal';
}

