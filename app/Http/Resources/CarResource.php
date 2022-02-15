<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'original_price' => $this->original_price,
            'actual_price' => $this->actual_price,
            'image' => $this->image,
            'quantity' => $this->quantity,
            'model' => $this->model,
            'size' => $this->size,
            'registration' => $this->registration,
            'status' => $this->status,

            'created_at' => $this->created_at->toDateTimeString(),

        ];
    }
}