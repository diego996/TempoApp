@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Raccolte</h2>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                            @if (session('errors'))
                                <div class="alert alert-success">
                                    {{ session('errors') }}
                                </div>
                            @endif
                        <div class="d-flex justify-content-between mb-3 text-center">

                            <a href="{{ route('raccolta.create') }}" class="btn btn-primary m-auto">Aggiungi nuova raccolta</a>
                        </div>
                        <table class="table table-striped" id="tabella_raccolta">
                            <thead>
                            <tr>
                                <th>Data</th>
                                <th>Quantità</th>
                                <th>Coltura</th>
                                <th>Commento</th>
                                <th scope="col">Azioni</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($raccolte as $raccolta)
                                <tr>
                                    <?php
                                    $ex = explode("-",$raccolta->data_raccolta);
                                    $quantita[] = $raccolta->quantita;
                                    $nomi[] = $raccolta->coltura->nome;
                                    $t = $ex["2"]."/".$ex["1"]."/".$ex["0"];
                                    ?>
                                    <td>{{ $t  }}</td>
                                    <td>{{ $raccolta->quantita }} g</td>
                                    <td>{{ $raccolta->coltura->nome }}</td>
                                        <td>{{ $raccolta->note }}</td>
                                        <td>
                                            {{--<a href="{{ route('colture.show', $coltura->id) }}" class="btn btn-sm btn-info">Visualizza</a>--}}
                                            <a href="{{ route('raccolta.edit', $raccolta->id) }}" class="btn btn-sm btn-primary">Modifica</a>
                                            <form action="{{ route('raccolta.destroy', $raccolta->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questa raccolta?')">Elimina</button>
                                            </form>
                                        </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
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
                    <div class="col-md-12 m-2">
                        <div class="card">
                            <div class="card-header text-center">
                                <h2>Grafico raccolta</h2>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>

        $(document).ready( function () {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php if(isset($nomi)){ json_encode($nomi);}else{echo"[]";}  ?>,
                datasets: [{
                    label: 'My First Dataset',
                    data:  <?php if(isset($quantita)){ json_encode($quantita);}else{echo"[]";}  ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                        'rgba(255, 206, 86)',
                        'rgba(75, 192, 192)',
                        'rgba(153, 102, 255)',
                        'rgba(255, 159, 64)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });  });
    </script>

@endsection



