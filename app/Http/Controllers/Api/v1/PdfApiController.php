<?PHP

namespace App\Http\Controllers\Api\v1;

use TCPDF;
use App\Pdf;
use App\Dokument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PdfApiController extends Controller
{
    public function index(){
        $pdf = new Pdf();
        $pdf->name = 'PDF';

        return $pdf;
    }

    public function store(Dokument $dokument){
        $name = 'Belegdokumentation';
        $html = '';
        foreach($bausteinTextArray as $baustein => $text){
            if($baustein == 'deckblatt'){
                $html .= $text;
            }elseif($baustein == 'inhaltsverzeichnis'){
                $html .= $text;
            }
        }

        new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        TCPDF::SetCreator('PDF_Generator');
        PDF::SetAuthor('Docubyte');
        PDF::SetTitle('Verfahrensdokumentation zur Belegablage');

        PDF::setHeaderData('', 0, '', "Verfahrensdokumentation zur Belegablage");
        PDF::setHeaderFont(array('dejavusans', '', 9));
        PDF::SetHeaderMargin(5);

        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        PDF::SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        PDF::SetMargins(15, PDF_MARGIN_TOP, 15);

        // PDF::setPrintFooter(true);
        // PDF::setFooterData(array(0,64,0), array(0,64,128));
        // PDF::setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        PDF::AddPage('P', 'A4');
        PDF::writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        if(array_key_exists('vorbemerkungen', $bausteinTextArray)){
            $html = $bausteinTextArray['vorbemerkungen'];
        }
        
        PDF::AddPage('P', 'A4');
        // PDF::writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output($name.'pdf', 'I');

    }
}

?>