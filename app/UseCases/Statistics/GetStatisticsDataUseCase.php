<?php

namespace App\UseCases\Statistics;

use App\Models\Transaction;
use App\UseCases\Contracts\Statistics\GetStatisticsDataUseCaseInterface;
use Illuminate\Support\Facades\Auth;

class GetStatisticsDataUseCase implements GetStatisticsDataUseCaseInterface
{
    public function handle(string $dateFrom, string $dateTo, string $role, string $userID)
    {
        if ($role == 'Administrator') {
            $failedTransactions = Transaction::where('status', 'failed')
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->count();

            $successTransactions = Transaction::where('status', 'successful')
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->count();

            $cancelledTransactions = Transaction::where('status', 'cancelled')
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->count();

            $acceptedTransactions = Transaction::where('status', 'accepted')
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->count();

            $holdTransactions = Transaction::where('status', 'hold')
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->count();
        }

        if ($role == 'Shopkeeper' || $role == 'Supplier') {
            $failedTransactions = Transaction::where([
                ($role == 'Shopkeeper') ? ['shopkeeper_id', $userID] : ['supplier_id', $userID],
                ['status', 'failed']
            ])
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->count();

            $successTransactions = Transaction::where([
                ($role == 'Shopkeeper') ? ['shopkeeper_id', $userID] : ['supplier_id', $userID],
                ['status', 'successful']
            ])
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->count();

            $cancelledTransactions = 0;

            $acceptedTransactions = Transaction::where([
                ($role == 'Shopkeeper') ? ['shopkeeper_id', $userID] : ['supplier_id', $userID],
                ['status', 'accepted']
            ])
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->count();

            $holdTransactions = Transaction::where([
                ($role == 'Shopkeeper') ? ['shopkeeper_id', $userID] : ['supplier_id', $userID],
                ['status', 'hold']
            ])
                ->whereBetween('date', [$dateFrom, $dateTo])
                ->count();
        }

        $data = [
            'failedTransactions' => $failedTransactions,
            'successTransactions' => $successTransactions,
            'cancelledTransactions' => $cancelledTransactions,
            'holdTransactions' => $holdTransactions,
            'acceptedTransactions' => $acceptedTransactions,
            'userRole' => $role,
            'userID' => $userID
        ];

        return $data;
    }
}
