<?php
include_once("/xampp/htdocs/Prueba_encuesta/www/procesar-encuesta.php");
?>

<!DOCTYPE html>
<html lang="en">

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
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #c2c2c2;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
        }

        label {
            font-weight: bold;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        input[type="number"] {
            border: 1px solid black;
        }

        input[type="submit"] {
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0069d9;
        }
    </style>
    <title>Encuesta DUOC</title>
</head>

<body>
    <div class="container">
        <h1>Encuesta de satisfacción</h1>

        <br>
        <hr>
        <p>Gracias por su tiempo y apoyo al contestar esta encuesta, favor conteste la respuesta que le parece correcta</p>
        <hr>
        <form action="" method="POST">
            <?php
            include_once("/xampp/htdocs/Prueba_encuesta/www/procesar-encuesta.php");
            ?>
            <div class="form-group">
                <label for="rut">Favor ingrese su RUT: </label>
                <input type="text" name="rut" class="form-control" minlength="8" maxlength="9" 
                style="width:20%;border: 1px solid black;" id="inputRut" placeholder="Ingresa tu RUT" 
                onchange="validarRut(this.value)">Sin puntos ni guion, 'K' mayuscula.
                <div id="mensajeValidacion"></div>
                <div class="alert alert-info d-none" role="alert" id="alerta">
                    <strong id="mensaje"></strong>
                </div>
                <script>
function validarRut(rut) {
    rut = rut.replace(/[\.-]/g, '');
    var dv = rut.slice(-1);
    var rutSinDv = rut.slice(0, -1);
    if (!/^(\d{1,3})(\d{3}){1,2}(\w{1})$/.test(rut)) {
        document.getElementById('mensajeValidacion').innerHTML = 'El RUT no es válido';
        return;
    }
    var sum = 0;
    var factor = 2;
    for (var i = rutSinDv.length - 1; i >= 0; i--) {
        sum += parseInt(rutSinDv.charAt(i)) * factor;
        factor = factor === 7 ? 2 : factor + 1;
    }
    if (rut && dv) {
        document.getElementById('mensajeValidacion').innerHTML = '';
        // Cálculo del dígito verificador esperado
        var dvEsperado = 11 - (sum % 11);
        dvEsperado = dvEsperado === 11 ? 0 : dvEsperado === 10 ? 'K' : dvEsperado.toString();
        if (dvEsperado === dv.toUpperCase()) {
            document.getElementById('mensajeValidacion').innerHTML = 'El RUT es válido';
        } else {
            document.getElementById('mensajeValidacion').innerHTML = 'El RUT no es válido';
        }
        setTimeout(function() {
            document.getElementById('mensajeValidacion').innerHTML = '';
        }, 2000);
    }
}

                </script>
                <br>
                <label for="edad">Edad:</label>
                <select type="text" name="edad" class="form-control" style="width:20%;border: 1px solid black;" id="edad">
                    <option selected disabled value="0"> Seleccionar ...</option>
                    <option value="15 a 25">15 a 25</option>
                    <option value="26 a 35">21 a 35</option>
                    <option value="36 a 45">36 a 45</option>
                    <option value="45 o mas">45 o mas</option>
                </select>
                <br>
                <label for="genero">Genero:</label>
                <br>
                <input type="radio" id="genero" name="genero" value="Masculino">Masculino
                <input type="radio" id="genero" name="genero" value="Femenino">Femenino
                <input type="radio" id="genero" name="genero" value="Sin_respuesta">Prefiero no responder
            </div>
            <br>
            <p>¿Estas de acuerdo en que el Instituto DUOC se aloje en nuestra comuna?</p>
            <label><input type="radio" name="alojar" value="Si">Si</label><br>
            <label><input type="radio" name="alojar" value="No">No</label><br>

            <p>¿Te gustaria que DUOC entregue beneficios educacionales a nuestros estudiantes?</p>
            <label><input type="radio" name="beneficios" value="Si">Si</label><br>
            <label><input type="radio" name="beneficios" value="No">No</label><br>

            <p>En caso de que DUOC entregue beneficios, ¿cuantas personas en tu nucleo familiar se podrian ver beneficiados?</p>
            <label><input type="radio" name="cantidad" value="1 a 3 personas">1 a 3 personas</label><br>
            <label><input type="radio" name="cantidad" value="4 a 5 personas">4 a 5 personas</label><br>
            <label><input type="radio" name="cantidad" value="mas de 5 personas">mas de 5 personas</label><br><br>

            <p>Si DUOC finalmente llega a nuestra comuna, ¿crees que la gente de La Pintana la elegira sobre otras instituciones?</p>
            <label><input type="radio" name="eleccion" value="Si">Si</label><br>
            <label><input type="radio" name="eleccion" value="No">No</label><br>
            <br>
            <input type="submit" name="enviar_encuesta" style="float:right" value="Enviar">
            <a href="../www/inicio.html" class="btn btn-success">Regresar</a>
        </form>
    </div>
</body>


</html>