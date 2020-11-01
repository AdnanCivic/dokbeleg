<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\JsonResource;

class BausteinResource extends JsonResource
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
            'name_nummer' => $this->name . '_' . $this->nummer,
            'marker' => $this->marker,
            'html' => $this->html,
        ];
    }
}
