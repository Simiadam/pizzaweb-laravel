<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PizzaResource extends JsonResource
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
            'name' => $this->name,
            'image' => $this->image,
            'type' => $this->type,
            'toppings' => $this->toppings,
            'price' => $this->price,
            'popularity' => $this->popularity,
            'active' => $this->active,
            'size' => $this->size,
            'quantity' => $this->quantity,
        ];
    }
}
