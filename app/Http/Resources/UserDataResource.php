<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDataResource extends JsonResource
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
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'account_number' => $this->Wallet ? $this->Wallet->account_number : '',
            'balance' => $this->wallet? number_format($this->Wallet->amount) : '',
            'profile' => asset('images/img/profile.png'),
            'hash_value' =>$this->phone
        ];
    }
}
