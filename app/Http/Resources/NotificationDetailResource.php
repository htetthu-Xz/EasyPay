<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationDetailResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->data['title'],
            'message' => $this->data['message'],
            'data_time' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'deep_link' => $this->data['deep_link']
        ];
    }
}
