<?php
// ----------------------------------------------------------
// PRUEBA PHP - GRÁFICO HISTÓRICO DEL ÍNDICE DE POBREZA EN PERÚ
// Objetivo: Consultar la API del Banco Mundial (PIP) entre 1995 y 2020
//           y graficar los valores del campo "headcount" usando Highcharts
// ----------------------------------------------------------

// Definimos el rango de años a consultar
$startYear = 1995;
$endYear = 2020;
$country = 'PER'; // Código de país para Perú

// Arreglo donde se almacenarán los datos obtenidos de la API
$data = [];

// Recorremos cada año y hacemos la consulta a la API
for ($year = $startYear; $year <= $endYear; $year++) {
    // URL de la API con los parámetros del país y el año
$url = "https://api.worldbank.org/pip/v1/pip?country=$country&year=$year";
    
    // Obtenemos el contenido de la URL (respuesta en JSON)
    $response = file_get_contents($url);

    // Convertimos el JSON en un arreglo de PHP
    $json = json_decode($response, true);
    
    // Validamos que el campo "headcount" exista y almacenamos el valor
    if (isset($json[0]['headcount'])) {
        $data[] = [
            'year' => $year,               // Año correspondiente
            'value' => $json[0]['headcount'] // Valor del índice de pobreza (%)
        ];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de Pobreza - Perú</title>
    <!-- Incluimos la librería Highcharts desde su CDN -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
    <h2>Índice de Pobreza en Perú (1995 - 2020)</h2>
    <!-- Div contenedor donde se mostrará el gráfico -->
    <div id="container" style="width:90%; height:400px;"></div>

    <script>
        // Esperamos que se cargue completamente el DOM
        document.addEventListener('DOMContentLoaded', function () {
            // Creamos el gráfico usando Highcharts
            Highcharts.chart('container', {
                chart: {
                    type: 'line' // Tipo de gráfico: línea
                },
                title: {
                    text: 'Índice de Pobreza en Perú'
                },
                xAxis: {
                    // Usamos los años extraídos desde PHP
                    categories: <?= json_encode(array_column($data, 'year')) ?>,
                    title: {
                        text: 'Año'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Poverty rate (%)' // Título del eje Y
                    }
                },
                series: [{
                    name: 'Perú',
                    // Valores del índice "headcount" extraídos desde PHP
                    data: <?= json_encode(array_column($data, 'value')) ?>
                }]
            });
        });
    </script>
</body>
</html>
