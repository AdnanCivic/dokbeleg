<?PHP

namespace App\Services;
use PDF;

class PdfPrinter
{
    
    public function printPdf($dokument){
        
        // $name = 'Belegdokumentation';
        // $html = '';

        $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        // TCPDF::SetCreator('PDF_Generator');
        // TCPDF::SetAuthor('Docubyte');
        $pdf::SetTitle($dokument->name);

        // TCPDF::setHeaderData('', 0, '', "Verfahrensdokumentation zur Belegablage");
        // TCPDF::setHeaderFont(array('dejavusans', '', 9));
        // TCPDF::SetHeaderMargin(5);

        // TCPDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // TCPDF::SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        // TCPDF::SetMargins(15, PDF_MARGIN_TOP, 15);

        // // PDF::setPrintFooter(true);
        // // PDF::setFooterData(array(0,64,0), array(0,64,128));
        // // PDF::setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // TCPDF::AddPage('P', 'A4');
        // TCPDF::writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        
        $pdf::AddPage('P', 'A4');
        // // PDF::writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        $pdf::writeHTML('<p>Inhalt Äüöß</p>', true, false, true, false, '');

        $pdf::Output($dokument->name.'.pdf', 'I');
        
    }
}

?>