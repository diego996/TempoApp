@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Colture</h2>
                    </div>

                    <div class="card-body">
                <div class="d-flex justify-content-between mb-3 text-center">

                    <a href="{{ route('colture.create') }}" class="btn btn-primary m-auto">Aggiungi nuova coltura</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-striped table-hover" id="table_colture">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        {{--<th scope="col" style="width: 20%!important;">Descrizione</th>--}}
                        <th scope="col">Costo</th>
                        <th scope="col">Profitto</th>
                        <th scope="col">Quantita raccolta</th>
                        {{--<th scope="col">Quantita per arrivare a pari</th>--}}
                        {{--<th scope="col">Quantita profitto 15%</th>--}}
                        <th scope="col">Azioni</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $prof_tot = 0;
                    $raccolta_tot = 0;
                    ?>
                    @foreach ($colture as $coltura)
                        <tr>
                            <th scope="row">{{ $coltura->id }}</th>
                            <td>{{ $coltura->nome }}</td>
                            {{--<td>{{ $coltura->descrizione }}</td>--}}
                            <td><?php if(isset($costi_colture[$coltura->id])){echo $costi_colture[$coltura->id]; }else{ echo "0"; } ?> €</td>
                            <td><span class="text-bold @if($profitto_array[$coltura->id]>0) text-success @else text-danger @endif"><?php if(isset($profitto_array[$coltura->id])){  $prof_tot = $prof_tot + $profitto_array[$coltura->id];  echo $profitto_array[$coltura->id]; }else{ echo "0"; } ?> €</span></td>
                            <td><?php $raccolta_tot = $raccolta_tot +  $quantita_raccolta[$coltura->id];  ?> {{ $quantita_raccolta[$coltura->id]}} g</td>
                            {{--<td>{{ $result[$coltura->id]["quantita_pari"] }}</td>--}}
                            {{--<td>{{  $result[$coltura->id]["quantita_profitto"] }}</td>--}}
                            <td>
                                {{--<a href="{{ route('colture.show', $coltura->id) }}" class="btn btn-sm btn-info">Visualizza</a>--}}
                                <a href="{{ route('colture.edit', $coltura->id) }}" class="btn btn-sm btn-primary">Modifica</a>
                                <form action="{{ route('colture.destroy', $coltura->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questa coltura?')">Elimina</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"><span class="text-bold @if($costi_totali<0) text-success @else text-danger @endif">{{$costi_totali}} €</span></th>
                        <th scope="col"><span class="text-bold @if($prof_tot>0) text-success @else text-danger @endif">{{$prof_tot}} €</span></th>
                        <th scope="col"><span class="text-bold ">{{$raccolta_tot}} g</span></th>
                        <th scope="col"></th>

                    </tr>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>
            <div class="col-md-4">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>METEO ATTUALE</h2>
                    </div>

                    <div class="card-body text-center">
                        <div id="weather">
                            <img id="weather-icon" style="width: 150px!important;height: 150px!important;margin-left: auto;margin-right: auto;" src="" alt="Weather Icon">
                            <span id="weather-desc"></span>
                            <span id="weather-temp" ></span>
                        </div>

                        <script>
                            $.ajax({
                                url: '/agromonitoring/weather/today/62fe9400e8d9ac376917118d',
                                success: function(data) {
                                    $('#weather-icon').attr('src', data.icon);
                                    $('#weather-desc').text(data.description);
                                    $('#weather-temp').text(data.temperature + '°C');
                                }
                            });
                        </script>
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>    </div>
@endsection

