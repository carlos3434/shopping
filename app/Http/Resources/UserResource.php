<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,

            'uuid' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role_type' => $this->role_type,
            'phone' => $this->phone,
            'address' => $this->address,

            'created_at' => $this->created_at->toDateTimeString(),

        ];
    }
}