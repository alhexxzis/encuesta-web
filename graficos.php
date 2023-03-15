<?php
$conexion = new mysqli("Localhost", "root", "", "encuesta_duoc", "3306");
$conexion->set_charset("utf8");
$sql_total = "SELECT count(id) AS total FROM encuesta_detalle";
$resultado_total = mysqli_query($conexion, $sql_total);
$row = mysqli_fetch_array($resultado_total);
$total_encuestados = $row['total'];

include_once('/xampp/htdocs/Prueba_encuesta/conexiones_grafico.php/edad.php');
include_once('/xampp/htdocs/Prueba_encuesta/conexiones_grafico.php/beneficios.php');
include_once('/xampp/htdocs/Prueba_encuesta/conexiones_grafico.php/eleccion.php');
include_once('/xampp/htdocs/Prueba_encuesta/conexiones_grafico.php/familia.php');
include_once('/xampp/htdocs/Prueba_encuesta/conexiones_grafico.php/genero.php');
include_once('/xampp/htdocs/Prueba_encuesta/conexiones_grafico.php/ubicacion.php');

?>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-image: url('../img/dfegvrb.png');
      padding-top: 40px;
    }

    .container {
      border-radius: 10px;
      background-color: #ffffff;
      display: flex;
      flex-wrap: wrap;
      box-shadow: 0px 0px 5px #c2c2c2;
      justify-content: space-between;
      max-height: 800px;
      max-width: 1800px;
      /* aquí se establece la altura máxima */
      overflow-y: auto;
    }

    .group {
      display: flex;
      flex-direction: row;
      justify-content: center;
      flex-basis: calc(33.33% - 10px);
      width: 100%;
      margin-bottom: 20px;
    }

    h1 {
      text-align: center;
      color: white;
      font-size: 70px;
    }
    h2{
      margin-left: 120px;
      font-style: border 1px color black;
      max-width: 28%;
      background-color: white;
      color: black;
      text-align: center;
      border-radius: 5px;
      box-shadow: 0px 0px 5px #c2c2c2;
    }

    a {
      margin-left: 40px;
      font-size: 30px;
    }

    #total_encuestados {
      border: 1px solid black;
      background-color: black;
    }
  </style>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <!-- Scripts Grafico Edad -->
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.arrayToDataTable(<?php echo json_encode($datos_edad); ?>);
      var options = {
        'title': 'EDAD PROMEDIO ENCUESTADOS',
        'width': 600,
        'height': 600,
        'fontSize': 18
      };
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
  </script>

  <!-- Scripts Grafico Beneficios -->
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.arrayToDataTable(<?php echo json_encode($datos_ben); ?>);
      var options = {
        'title': '¿Te gustaria que DUOC entregue beneficios educacionales a nuestros estudiantes?',
        'width': 600,
        'height': 600,
        'fontSize': 18
      };
      var chart = new google.visualization.PieChart(document.getElementById('chart_div_2'));
      chart.draw(data, options);
    }
  </script>

  <!-- Scripts Grafico eleccion -->
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.arrayToDataTable(<?php echo json_encode($datos_ele); ?>);
      var options = {
        'title': 'Si DUOC finalmente llega a nuestra comuna, ¿crees que la gente de La Pintana la elegira sobre otras instituciones?',
        'width': 600,
        'height': 600,
        'fontSize': 18
      };
      var chart = new google.visualization.PieChart(document.getElementById('chart_div_3'));
      chart.draw(data, options);
    }
  </script>

  <!-- Scripts Grafico familia -->
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.arrayToDataTable(<?php echo json_encode($datos_fam); ?>);
      var options = {
        'title': 'En caso de que DUOC entregue beneficios, ¿cuantas personas en tu nucleo familiar se podrian ver beneficiados?',
        'width': 600,
        'height': 600,
        'fontSize': 18
      };
      var chart = new google.visualization.PieChart(document.getElementById('chart_div_4'));
      chart.draw(data, options);
    }
  </script>

  <!-- Scripts Grafico genero -->
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.arrayToDataTable(<?php echo json_encode($datos_gen); ?>);
      var options = {
        'title': 'GENERO',
        'width': 600,
        'height': 600,
        'fontSize': 18
      };
      var chart = new google.visualization.PieChart(document.getElementById('chart_div_5'));
      chart.draw(data, options);
    }
  </script>

  <!-- Scripts Grafico ubicacion -->
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.arrayToDataTable(<?php echo json_encode($datos_ubi); ?>);
      var options = {
        'title': '¿Estas de acuerdo en que el Instituto DUOC se aloje en nuestra comuna?',
        'width': 600,
        'height': 600,
        'fontSize': 18
      };
      var chart = new google.visualization.PieChart(document.getElementById('chart_div_6'));
      chart.draw(data, options);
    }
  </script>
  <h1>Estadisticas de las respuestas </h1>
  <h2>Total Encuestados:   <?php echo $total_encuestados ?> personas</h2>
</head>
<br>
<body>
  <div class="container">
    <div class="group">
      <div id="chart_div"></div>
    </div>
    <div class="group">
      <div id="chart_div_5"></div>
    </div>
    <div class="group">
      <div id="chart_div_6"></div>
    </div>
    <div class="group">
      <div id="chart_div_2"></div>
    </div>
    <div class="group">
      <div id="chart_div_4"></div>
    </div>
    <div class="group">
      <div id="chart_div_3"></div>
    </div>
  </div>
  <br>
  <a href="../www/inicio.html" style="font-size:20px;" class="btn btn-success">Regresar</a>
  <a href="../www/portada.php" style="float:right; font-size:20px;" class="btn btn-primary">Ir a la encuesta</a>
</body>
</html>