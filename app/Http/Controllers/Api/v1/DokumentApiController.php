<?php

namespace App\Http\Controllers\Api\v1;

use App\Dokument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\DokumentResource;
use App\Http\Resources\v1\DokumentResourceCollection;

class DokumentApiController extends Controller
{
    public function index(Request $request): DokumentResourceCollection{
        $user_id = $request->user()->id;
        return new DokumentResourceCollection(Dokument::where('user_id', $user_id)->paginate(5));
    }

    public function show(Dokument $dokument): DokumentResource{
        $dokument->gruppen = $dokument->gruppes;
        return new DokumentResource($dokument);
    }

    public function store(Request $request){

    }

    public function update(Dokument $dokument, Request $request): DokumentResource{

    }

    public function destroy(Dokument $dokument){
        
    }
}

?>