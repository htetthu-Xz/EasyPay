<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        $title = '';

        if($this->type == 1) {
            $title = 'From';
        } else {
            $title = 'To';
        }
        return [
            'trx_id' => $this->trx_id,
            'ref_no' => $this->ref_no,
            'amount' => number_format($this->amount, 2) . ' MMK',
            'type' => $this->type, // 1 => income, 2 => expense
            'title' => $title,
            'date_time' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'source' => $this->Source->name
        ];
    }
}
