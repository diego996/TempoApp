@extends('layouts.app')

@section('content')
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('errors'))
                    <div class="alert alert-success">
                        {{ session('errors') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Lavorazioni</h2>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                            <div class="d-flex justify-content-between mb-3 text-center">
        <button type="button" class="btn btn-primary m-auto" data-bs-toggle="modal" data-bs-target="#addLavorazioneModal">
            Aggiungi nuova lavorazione
        </button>
                            </div>
        <table  class="table table-striped" id="table_lavorazioni">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome coltura</th>
                <th scope="col">Tipo</th>

                {{--<th scope="col" style="width: 15%!important;">Descrizione</th>--}}
                <th scope="col">Data lav</th>
                <th scope="col">Costo lav</th>
                <th scope="col">Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php $costo = 0;?>
            @foreach($lavorazioni as $lavorazione)
                <?php

                if(isset($quantita[$lavorazione->id_coltura])){
                    $quantita[$lavorazione->coltura_id] = $lavorazione->costo + $quantita[$lavorazione->id_coltura] ;
                }else{
                    $quantita[$lavorazione->coltura_id] = $lavorazione->costo   ;
                }

                ?>
                <tr>
                    <th scope="row">{{$lavorazione->id}}</th>
                    <td>{{$nome_coltura[$lavorazione->coltura_id]}}</td>
                    <td>{{$lavorazione->tipo_lavorazione}} - {{$lavorazione->descrizione}}</td>

                    {{--<td>{{$lavorazione->descrizione}}</td>--}}
                    <td>{{$lavorazione->data_lavorazione}} </td>
                    <td>{{$lavorazione->costo}} €</td>
                    <?php $costo = $lavorazione->costo + $costo;?>
                    <td>
                        <a href="{{ route('lavorazioni.edit', $lavorazione->id) }}" class="btn btn-primary btn-sm">Modifica</a>
                        <form action="{{ route('lavorazioni.destroy', $lavorazione->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th scope="col"></th>
                <th scope="col"></th>


                <th scope="col">Costi complessivi</th>
                <th scope="col"> <?php echo $costo;?> €</th>
                <th scope="col"></th>
            </tr>
            </tfoot>
        </table>
        <div class="modal fade" id="addLavorazioneModal" tabindex="-1" role="dialog" aria-labelledby="addLavorazioneModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Aggiungi Lavorazione</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addForm" action="{{ route('lavorazioni.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="coltura_id">Coltura</label>
                                <select class="form-control" id="coltura_id" name="coltura_id">
                                    @foreach($colture as $coltura)
                                        <option value="{{ $coltura->id }}">{{ $coltura->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nome">Nome Lavorazione</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Inserisci il nome della lavorazione" required>
                            </div>

                            <div class="form-group">
                                <label for="tipo_lavorazione">Tipo di lavorazione</label>
                                <select name="tipo_lavorazione" class="form-control" required>
                                    <option value="">Seleziona il tipo di lavorazione</option>
                                    <option value="irrigazione">Irrigazione</option>
                                    <option value="semina">Semina</option>
                                    <option value="manutenzione">Manutenzione</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="data" class="form-label">Data</label>
                                <input type="text" class="form-control" id="data_lavorazione" name="data_lavorazione">
                            </div>
                            <div class="form-group">
                                <label for="descrizione">Descrizione</label>
                                <textarea class="form-control" id="descrizione" name="descrizione" rows="3" placeholder="Inserisci una descrizione della lavorazione" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                                <button type="submit" class="btn btn-primary">Aggiungi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div></div></div>
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
                                <h2>Grafico</h2>
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

        $(document).ready(function () {
            $('#table_lavorazioni').DataTable();
        });
        $(document).ready( function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: <?= json_encode($nome_coltura); ?>,
                    datasets: [{
                        label: 'COSTO LAVORAZIONE',
                        data: <?= json_encode($quantita); ?>,
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
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.datasets[tooltipItem.datasetIndex].label || '';

                                if (label) {
                                    label += ': ';
                                }

                                label += tooltipItem.yLabel.toFixed(2) + ' €';

                                return label;
                            }
                        }

                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });  });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
@endsection
