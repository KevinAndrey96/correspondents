<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AllTransactionsByUserResource extends JsonResource
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
            'type' => 'transaction',
            'attributes' => [
                'id' => $this->id,
                'account_number' => $this->account_number,
                'amount' => $this->amount,
                'type' => $this->type,
                'status' => $this->status,
                'product' => $this->product,
                'detail' => $this->detail,
                'date' => $this->date,
                'voucher' => $this->voucher,
                'comment' => $this->comment,
                'observation' => $this->observation,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
             ]
        ];
    }
}
