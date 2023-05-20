@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $coltura->nome }}</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Descrizione:</strong> {{ $coltura->descrizione }}</p>
                        <p><strong>Costo:</strong> {{ $coltura->costo }}</p>
                        <p><strong>Profitto:</strong> {{ $coltura->profitto }}</p>
                        <hr>
                        <h4>Lavorazioni:</h4>

                        @if ($lavorazioni)
                            @if (count($lavorazioni) > 0)
                                <ul>
                                    @foreach ($lavorazioni as $lavorazione)
                                        <li>{{ $lavorazione->nome }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Nessuna lavorazione associata a questa coltura.</p>
                            @endif
                        @else
                            <p>Nessuna lavorazione associata a questa coltura.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
