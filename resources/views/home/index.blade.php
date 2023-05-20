@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h2>Previsioni del Tempo</h2>
            </div>
            <div class="card-body">


                <div class="row">
                    <div class="col-md-4">
                        <h2 class="text-success">Tempo attuale</h2>
                        <p>City: {{ $forecast['name'] }}</p>
                        <p>Temperatura: {{ $forecast['main']['temp'] }}°C</p>
                        <p>Umidità: {{ $forecast['main']['humidity'] }}%</p>
                        <!-- Aggiungi altri dati delle previsioni che desideri visualizzare -->
                    </div>

                    <div class="col-md-8">
                        <div id="openweathermap-widget-11">

                        </div>
                        <script src='//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/d3.min.js'></script>
                        <script>
                            window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];
                            window.myWidgetParam.push({
                                id: 11,
                                cityid: '3175491',
                                appid: 'f0c0b0b56729998f56dcd0b9b2455cc1',
                                units: 'metric',
                                containerid: 'openweathermap-widget-11',
                            });
                            (function() {
                                var script = document.createElement('script');
                                script.async = true;
                                script.charset = "utf-8";
                                script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";
                                var s = document.getElementsByTagName('script')[0];
                                s.parentNode.insertBefore(script, s);
                            })();
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
