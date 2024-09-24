<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'type' => 'transaction_detail',
            'attributes' => [
                'transaction_id' => $this->transactionID,
                'transaction_status' => $this->transactionStatus,
                'account_number' => $this->accountNumber,
                'transaction_type' => $this->transactionType,
                'amount' => $this->transactionAmount,
                'transaction_detail' => $this->transactionDetail,
                'product_id' => $this->productID,
                'product_name' => $this->productName
            ]

        ];
    }
}
