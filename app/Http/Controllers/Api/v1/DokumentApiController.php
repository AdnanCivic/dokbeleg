<?php

namespace App\Http\Controllers\Api\v1;

use App\Dokument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\DokumentResourceCollection;

class DokumentApiController extends Controller
{
    public function index(): DokumentResourceCollection{
        return new DokumentResourceCollection(Dokument::all());
    }
}

?>