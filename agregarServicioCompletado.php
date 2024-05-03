<?php
    // Se incluye el archivo de conexión a la base de datos
    include_once "conexion.php";

    // Se obtiene el id del empleado
    $idEmpleado = isset($_POST["idEmpleado"]) ? $_POST["idEmpleado"] : "";
    // Se obtiene el id del servicio
    $idServicio = isset($_POST["idServicio"]) ? $_POST["idServicio"] : "";
    // Se obtiene el id del empleado que completó el servicio
    $idUsuario = isset($_POST["idUsuario"]) ? $_POST["idUsuario"] : "";
    // Se obtiene la fecha del servicio completado usando la fecha actual en formato YYYY-MM-DD
    $fecha = date("Y-m-d");

    // Se inserta el servicio completado en la tabla de servicios completados
    $sql = "INSERT INTO serviciosCompletados (idServicio, idEmpleado, idUsuario,  fecha) VALUES ('$idServicio', '$idEmpleado', '$idUsuario', '$fecha')";
    if ($mysqli->query($sql) === TRUE) {
        echo "<script>alert('Servicio completado agregado exitosamente');</script>";
        echo "<script>window.location = 'home.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
?>