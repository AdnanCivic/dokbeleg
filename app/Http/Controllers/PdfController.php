<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function createText(Request $request){
        $requestArray = $request->all();
        unset($requestArray['_token']);
        unset($requestArray['submit']);

        $textbausteinePath = storage_path('app/text_bausteine/');
        $pdfHTML = '';

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

                $druckHtml = $this->variablenErsetzen($key, $html, $value);
                
                $pdfHTML .= $druckHtml;
            }
        }
        
        $this->createPdf($pdfHTML);
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


    public function createPdf($htmlText){
        $html = $htmlText;
        $name = 'TestPDF';
        new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        PDF::SetCreator('PHP_PDF_Generator');
        PDF::SetPrintHeader(true);
        PDF::SetPrintFooter(true);
        PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        PDF::AddPage('P', 'A4');
        
        PDF::writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        PDF::Output($name.'pdf', 'I');

        // PDF::Output(storage_path('app/public/'.$name.'.pdf'), 'F');
        // return redirect()->route('pdf')->with('success', 'Eine PDF wurde erstellt.');

    }
}

