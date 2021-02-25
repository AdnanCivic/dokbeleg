<?PHP

namespace App\Http\Controllers\Api\v1;

use App\Pdf;
use App\Dokument;
use App\Services\PdfPrinter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PdfResourceCollection;

class PdfApiController extends Controller
{
    public function index(Request $request): PdfResourceCollection{
        return new PdfResourceCollection(Pdf::where('dokument_id', $request->id)->orderBy('id','desc')->paginate(5));
    }

    public function store(Request $request){
        $dokument = Dokument::where('id', $request->id)->first();
        $pdf = new PdfPrinter();
        $result = $pdf->printPdf($dokument);

        return response($result);
    }
    
}

?>