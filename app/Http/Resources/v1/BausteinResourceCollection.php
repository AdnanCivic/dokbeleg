<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BausteinResourceCollection extends ResourceCollection
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // if (rand(1, 10) < 5) {
        //     abort(500, 'Vorgang fehlgeschlagen.');
        // }

        return parent::toArray($request);
    }
}

?>