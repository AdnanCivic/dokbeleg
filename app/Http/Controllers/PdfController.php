<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function createText(Request $request){
        $requestArray = $request->all();
        unset($requestArray['_token']);
        unset($requestArray['submit']);

        $textbausteinePath = storage_path('app/text_bausteine/');
        $bausteinTextArray = [];

        foreach($requestArray as $key => $value){
            $file = glob($textbausteinePath.$key.".htm");
            if($file[0]){
                $html = '';
                $handle = fopen($file[0], 'rb');
                while($line = fgets($handle)){
                    $html .= trim($line);
                }
                fclose($handle);
                
                $html = str_replace("'", "\"", $html);
                $html = utf8_encode($html);
                
                $druckHtml = $this->variablenErsetzen($key, $html, $value);
                
                $bausteinTextArray[$key] = $druckHtml;
            }
        }
        
        $this->createPdf($bausteinTextArray);
    }

    public function variablenErsetzen($baustein, $html, $datenArray){
        $daten = array_values($datenArray);
        
        if($baustein == 'deckblatt'){
            //$date = date("d.m.Y", strtotime($request['deckblatt']['datum']));
            $druckHtml = str_replace(["[Unternehmensname]", "[Versionsnummer]", "[Datum]"], $daten, $html);
        }elseif($baustein == 'inhaltsverzeichnis'){
            $druckHtml = $html;
        }elseif($baustein == 'vorbemerkungen'){
            $druckHtml = str_replace(["[Vorstand, Geschäftsführer, Inhaber]", "[Datum]", "[Name]", "[Bezeichnung]", "[Datum]", "[Versionsbezeichnung]"], $daten, $html);
        }
        
        return $druckHtml;
    }
        
    
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
            $html .= $text;
        }

        new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        PDF::SetCreator('PDF_Generator');
        PDF::SetAuthor('Docubyte');
        PDF::SetTitle('Verfahrensdokumentation zur Belegablage');
        // PDF::SetPrintHeader(true);
        // PDF::setHeaderData('', 0, 'marks', "Verfahrensdokumentation zur Belegablage");
        // PDF::setHeaderFont(array('dejavusans', '', 14));
        // PDF::SetHeaderMargin(30);

        PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        PDF::AddPage('P', 'A4');
        
        PDF::writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        PDF::Output($name.'pdf', 'I');

    }
}

