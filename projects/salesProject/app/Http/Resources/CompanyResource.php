<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name' => $this->nome,
            'name_fantasy' => $this->name_fantasy,
            'cnpj' => $this->cnpj,
            'unity' => new UnityResource($this->whenLoaded('unity')),
        ];
    }
}
