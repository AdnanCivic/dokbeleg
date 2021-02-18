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
        $dokument->gruppenDokument = $dokument->gruppes;
        return new DokumentResource($dokument);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'gruppenDokument' => ['array', 'min:1']
        ]);

        $anzahlGruppen = count($request->gruppenDokument);
        $gruppen = $request->gruppenDokument;
        $gruppenIds = array_column($gruppen, 'id');

        $validatedData['anzahlGruppen'] = $anzahlGruppen;
        $validatedData['user_id'] = $request->user()->id;

        $dokumentNeu = Dokument::create($validatedData);

        $dokumentNeu->gruppes()->attach($gruppenIds);
        
        return new DokumentResource($dokumentNeu);
    }

    public function update(Dokument $dokument, Request $request): DokumentResource{
        $validatedData = $request->validate([
            'name' => 'required',
            'gruppenDokument' => ['array', 'min:1']
        ]);

        $anzahlGruppen = count($request->gruppenDokument);
        $gruppen = $request->gruppenDokument;
        $gruppenIds = array_column($gruppen, 'id');

        $validatedData['anzahlGruppen'] = $anzahlGruppen;
        $validatedData['user_id'] = $request->user()->id;

        $dokument->update($validatedData);
        $dokument->gruppes()->sync($gruppenIds);

        $dokument->gruppenDokument = $dokument->gruppes;
        
        return new DokumentResource($dokument);
    }

    public function destroy(Dokument $dokument){
        $dokument->gruppes()->detach();
        $dokument->delete();

        return response()->json();
    }
}

?>