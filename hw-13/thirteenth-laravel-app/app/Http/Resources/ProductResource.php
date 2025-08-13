<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'sku'        => $this->sku,
            'name'       => $this->name,
            'price'      => $this->price, // cast decimal:3 — ок
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
