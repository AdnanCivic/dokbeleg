<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class BausteinResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        // if (rand(1, 10) < 3) {
        //     abort(500, 'Vorgang fehlgeschlagen.');
        // }
        
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

?>