<?php

namespace App\Http\Resources\v1;

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
        return parent::toArray($request);

        // so werden ausgewählte keys returned
        // return [
        //     'id' => $this->id,
        //     'name' => $this->name,
        //     'nummer' => $this->nummer,
        //     'marker' => $this->marker,
        // ];
    }
}
