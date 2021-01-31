<?php

namespace App\Http\Controllers\Api\v1;

use App\Dokumentation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\DokumentationResourceCollection;

class DokumentationApiController extends Controller
{
    public function index(): DokumentationResourceCollection{
        return new DokumentationResourceCollection(Dokumentation::all());
    }
}

?>