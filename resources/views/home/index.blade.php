@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Previsioni del Tempo</h1>

                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-success">Tempo attuale</h2>
                        <p>City: {{ $forecast['name'] }}</p>
                        <p>Temperatura: {{ $forecast['main']['temp'] }}°C</p>
                        <p>Umidità: {{ $forecast['main']['humidity'] }}%</p>
                        <!-- Aggiungi altri dati delle previsioni che desideri visualizzare -->
                    </div>

                    <div class="col-md-6">
                        <div id="openweathermap-widget-21"></div>
                        <script src='//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/d3.min.js'></script>
                        <script>
                            window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];
                            window.myWidgetParam.push({
                                id: 21,
                                cityid: '3175491',
                                appid: 'f0c0b0b56729998f56dcd0b9b2455cc1',
                                units: 'metric',
                                containerid: 'openweathermap-widget-21',
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
