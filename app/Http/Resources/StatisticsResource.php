<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $failedTransactions
 * @property mixed $successTransactions
 * @property mixed $cancelledTransactions
 * @property mixed $holdTransactions
 * @property mixed $acceptedTransactions
 * @property mixed $userRole
 * @property mixed $userID
 */
class StatisticsResource extends JsonResource
{
    public function __construct($failedTransactions, $successTransactions, $cancelledTransactions, $holdTransactions,
                                $acceptedTransactions, $userRole, $userID)
    {
        $this->failedTransactions = $failedTransactions;
        $this->successTransactions = $successTransactions;
        $this->cancelledTransactions = $cancelledTransactions;
        $this->holdTransactions = $holdTransactions;
        $this->acceptedTransactions =  $acceptedTransactions;
        $this->userRole =  $userRole;
        $this->userID =  $userID;
     }

    public function toArray($request)
    {
        return [
            'type' => 'statistics-data',
            'attributes' => [
                'failedTransactions' => $this->failedTransactions,
                'successTransactions' => $this->successTransactions,
                'cancelledTransactions' => $this->cancelledTransactions,
                'holdTransactions' => $this->holdTransactions,
                'acceptedTransactions' => $this->acceptedTransactions,
            ],
        ];
    }
}
