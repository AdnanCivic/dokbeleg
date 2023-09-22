<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class GruppeResource extends JsonResource
{
    
    public function toArray($request)
    {    
        return parent::toArray($request);
    }
}

?>