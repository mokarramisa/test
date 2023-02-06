<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\OrdersResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'email' => $this->email,
            'role'  => $this->role,
            'orders' => OrdersResource::collection($this->orders)
        ];
    }
}
