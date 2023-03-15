<?php
$conexion = new mysqli("Localhost", "root", "", "encuesta_duoc", "3306");
$conexion->set_charset("utf8");

if (isset($_POST['enviar_encuesta'])) {
  
  // Validar que los campos no estén vacíos
  if(empty($_POST['rut']) || empty($_POST['edad']) || empty($_POST['genero']) || empty($_POST['alojar']) || empty($_POST['beneficios']) || empty($_POST['cantidad']) || empty($_POST['eleccion'])) {
    // si hay campos vacíos, muestra un mensaje de error o redirige a la página anterior
    echo '<div class="alert alert-warning" id="respuestas">' . htmlspecialchars("Error: Favor responder todas las preguntas de la encuesta") . '</div>';
    echo '<script>window.onload = function() { setTimeout(function() { document.getElementById("respuestas").remove(); }, 2000); }</script>';

  } else {
    // Escapar los datos de entrada
    $rut = mysqli_real_escape_string($conexion, $_POST['rut']);
    $edad = mysqli_real_escape_string($conexion, $_POST['edad']);
    $genero = mysqli_real_escape_string($conexion, $_POST['genero']);
    $alojar = mysqli_real_escape_string($conexion, $_POST['alojar']);
    $beneficios = mysqli_real_escape_string($conexion, $_POST['beneficios']);
    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $eleccion = mysqli_real_escape_string($conexion, $_POST['eleccion']);
    // Verificar si el RUT ya ha contestado la encuesta
    $sql_verificar_rut = mysqli_query($conexion, "SELECT * FROM encuesta_detalle WHERE rut = '$rut'");
    if(mysqli_num_rows($sql_verificar_rut) > 0){
      echo '<div class="alert alert-danger" id="mensaje">ERROR: Rut asociado ya contestó la encuesta</div>';
      echo '<script>window.onload = function() { setTimeout(function() { document.getElementById("mensaje").remove(); }, 2000); }</script>';      
    }else{
        // Insertar las respuestas en la base de dato
    // Utilizar sentencias preparadas
    $stmt = $conexion->prepare("INSERT INTO encuesta_detalle (rut,edad, genero, ubicacion, beneficios, familia, eleccion) VALUES (?,?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss",$rut, $edad, $genero, $alojar, $beneficios, $cantidad, $eleccion);
    $stmt->execute();

    // Redirigir a la página de inicio
    header('Location: http://localhost/Prueba_encuesta/www/respuesta.html');
    exit();
  } // terminar la ejecución del script
  }
}
?>


