<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PdfResourceCollection extends ResourceCollection
{
    
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

?>