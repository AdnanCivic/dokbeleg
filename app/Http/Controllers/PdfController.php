<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
 
    public function auswahl(){
        $textbausteinePath = storage_path('app/text_bausteine/');
        $filesArray = glob($textbausteinePath.'*.htm');
        $namenArray = [];

        foreach($filesArray as $textbaustein){
            $dateiname = pathinfo($textbaustein, PATHINFO_FILENAME);
            array_push($namenArray, $dateiname);
        }
        
        return view('formulare.auswahl', compact('namenArray'));
        
    }

    public function postauswahl(Request $request){
        $namenTextbausteine = $request->input("textbausteine");
        return view('formulare.fieldset', compact('namenTextbausteine'));
    }


    public function createPdf($bausteinTextArray){
        $name = 'Belegdokumentation';
        $html = '';
        foreach($bausteinTextArray as $baustein => $text){
            if($baustein == 'deckblatt'){
                $html .= $text;
            }elseif($baustein == 'inhaltsverzeichnis'){
                $html .= $text;
            }
        }

        new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        PDF::SetCreator('PDF_Generator');
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

