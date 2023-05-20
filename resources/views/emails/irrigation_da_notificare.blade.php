@extends('layouts.mail')

@section('content')

        @if($irrigations == "test")
            <h3>Colture da irrigare</h3>
            <p>Nessuna coltura necessita di irrigazione</p>
            @else
            <h3>Colture da irrigare</h3>

            <p>Le seguenti colture necessitano di essere irrigate:</p>
            <ul>
            @foreach($irrigations as $irrigation)
                <li>{{$irrigation["colture_id"]}} <br> Fase attuale:{{$irrigation["phase"]}} <br>Ultima irrigazione: {{$irrigation["last_irrigation"]}}<br><br></li>
            @endforeach
            </ul>
            <a href="https://vps.diegodiego.it/irrigazione_tramite_email"><button class="btn btn-success">IRRIGAZIONE COMPLETATA</button></a>
            @endif


    <p>Cordiali saluti,</p>
    <p>Il tuo team wegrow</p>
@endsection