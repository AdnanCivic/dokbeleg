@extends('layouts.app')

@section('content')
    <div class="progress">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <form id="registration_form" novalidate action="{{ route('createtext') }}"  method="post">
    @csrf
    @if(in_array('deckblatt', $namenTextbausteine))
        <fieldset>
            <legend style="text-align: center">Deckblatt</legend>
            <div class="form-group">
                <label for="unternehmensname">Unternehmensname</label>
                <input type="text" class="form-control" id="unternehmensname" name="deckblatt[unternehmensname]" placeholder="Unternehmensname">
            </div>
            <div class="form-group">
                <label for="versionsnummer">Versionsnummer</label>
                <input type="text" class="form-control" id="versionsnummer" name="deckblatt[versionsnummer]" placeholder="Versionsnummer">
            </div>
            <div class="form-group">
                <label for="date">Datum</label>
                <input type="date" class="form-control" id="date" name="deckblatt[datum]" placeholder="Datum">
            </div>
                <input type="button" name="next" class="next btn btn-info" value="Weiter" />
        </fieldset>
    @endif
    @if(in_array('inhaltsverzeichnis', $namenTextbausteine))
        <fieldset>
            <legend style="text-align: center">Inhaltsverzeichnis</legend>
            <div class="form-group">
                <label>Keine Angaben notwendig.</label>
                <input type="hidden" name="inhaltsverzeichnis[]">
            </div>
            <input type="button" name="previous" class="previous btn btn-secondary" value="Zurück" />
            <input type="button" name="next" class="next btn btn-info" value="Weiter" />
        </fieldset>
    @endif
    @if(in_array('vorbemerkungen', $namenTextbausteine))
        <fieldset>
            <legend style="text-align: center">Vorbemerkungen</legend>
            <div class="form-group">
                <label for="vorstand">Vorstand</label>
                <input type="text" class="form-control" id="vorstand" name="vorbemerkungen[vorstand]" placeholder="Vorstand, Geschäftsführer, Inhaber">
            </div>
            <div class="form-group">
                <label for="freigabedatum">Freigabedatum</label>
                <input type="date" class="form-control" id="freigabedatum" name="vorbemerkungen[freigabedatum]">
            </div>
            <div class="form-group">
                <label for="versionsbezeichnung">Versionsbezeichnung</label>
                <input type="text" class="form-control" id="versionsbezeichnung" name="vorbemerkungen[versionsbezeichnung]" placeholder="Versionsbezeichnung">
            </div>
            <div class="form-group">
                <label for="aktualisierungsdatum">Aktualisierungsdatum</label>
                <input type="date" class="form-control" id="aktualisierungsdatum" name="vorbemerkungen[aktualisierungsdatum]" placeholder="Aktualisierungsdatum">
            </div>
            <div class="form-group">
                <label for="bversionsbezeichnung">Bisherige Verfahrensdokumentation</label>
                <input type="text" class="form-control" id="bversionsbezeichnung" name="vorbemerkungen[bversionsbezeichnung]" placeholder="Versionsbezeichnung">
            </div>
            <input type="button" name="previous" class="previous btn btn-secondary" value="Zurück"/>
            <input type="button" name="next" class="next btn btn-info" value="Weiter" />
        </fieldset>
    @endif
        <fieldset>
            <legend>Drucken der Dokumentation</legend>
            <input type="submit" name="submit" class="submit btn btn-success" value="PDF drucken"/>
        </fieldset>
    </form>
    <script>
        $(document).ready(function(){
        var current = 1,current_step,next_step,steps;
        steps = $("fieldset").length;
        $(".next").click(function(){
        current_step = $(this).parent();
        next_step = $(this).parent().next();
        next_step.show();
        current_step.hide();
        setProgressBar(++current);
        });
        $(".previous").click(function(){
            current_step = $(this).parent();
            next_step = $(this).parent().prev();
            next_step.show();
            current_step.hide();
            setProgressBar(--current);
        });
        setProgressBar(current);
        // Change progress bar action
        function setProgressBar(curStep){
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
        .css("width",percent+"%")
        .html(percent+"%");   
        }
        });
    </script>
@endsection