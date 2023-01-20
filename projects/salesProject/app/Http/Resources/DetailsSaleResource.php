<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailsSaleResource extends JsonResource
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
            'date_sale' => Carbon::createFromFormat('Y-m-d H:i:s', $this->date_sale)->format('d/m/Y H:i'),
            'value' => number_format($this->value, 2, ',', '.'),
            'roaming' => $this->roaming,
            'link_iframe_maps' => "https://maps.google.com/maps?q={$this->latitude},{$this->longitude}&hl=es&z=14&amp;output=embed",
            'salesman' =>  new UserResource($this->user)
        ];
    }
}
