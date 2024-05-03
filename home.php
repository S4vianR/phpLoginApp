<!DOCTYPE html>
<html lang="MX">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/home.css">
    <link rel="icon" type="image/png" href="/assets/logo-opengate.png">
    <title>Home</title>
</head>

<body>
    <?php
    session_start();
    $nombreUsuario = $_SESSION['nombreUsuario'];
    // Array de empleados
    $empleados = array();
    // Array de servicios
    $servicios = array();
    // Array de servicios completados
    $serviciosCompletados = array();

    // Se incluye el archivo de conexión a la base de datos
    include_once "conexion.php";

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        // Select de la tabla de empleados
        $sql = "SELECT * FROM empleados";
        $result = $mysqli->query($sql);

        // La estructura de la tabla
        //         MariaDB [opengate]> DESCRIBE empleados;
        // +-----------------+---------+------+-----+---------+-------+
        // | Field           | Type    | Null | Key | Default | Extra |
        // +-----------------+---------+------+-----+---------+-------+
        // | idEmpleado      | int(11) | NO   | PRI | NULL    |       |
        // | primerNombre    | text    | NO   |     | NULL    |       |
        // | primerApellido  | text    | NO   |     | NULL    |       |
        // | fechaNacimiento | date    | NO   |     | NULL    |       |
        // +-----------------+---------+------+-----+---------+-------+

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $empleado = array(
                    "idEmpleado" => $row["idEmpleado"],
                    "primerNombre" => $row["primerNombre"],
                    "primerApellido" => $row["primerApellido"],
                    "fechaNacimiento" => $row["fechaNacimiento"]
                );
                array_push($empleados, $empleado);
            }
        }

        // Select de la tabla de servicios
        $sql2 = "SELECT * FROM servicios";

        // La estructura de la tabla
        //         MariaDB [opengate]> DESCRIBE servicios;
        // +----------------+---------+------+-----+---------+-------+
        // | Field          | Type    | Null | Key | Default | Extra |
        // +----------------+---------+------+-----+---------+-------+
        // | idServicio     | int(11) | NO   | PRI | NULL    |       |
        // | nombreServicio | text    | NO   |     | NULL    |       |
        // +----------------+---------+------+-----+---------+-------+

        $result2 = $mysqli->query($sql2);
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                $servicio = array(
                    "idServicio" => $row["idServicio"],
                    "nombreServicio" => $row["nombreServicio"]
                );
                array_push($servicios, $servicio);
            }
        }

        // Select de la tabla de servicios completados
        // Estrucutra de la tabla
        // MariaDB [opengate]> DESCRIBE serviciosCompletados;
        // +------------+---------+------+-----+---------+-------+
        // | Field      | Type    | Null | Key | Default | Extra |
        // +------------+---------+------+-----+---------+-------+
        // | idServicio | int(11) | NO   | MUL | NULL    |       |
        // | idEmpleado | int(11) | NO   | MUL | NULL    |       |
        // | idUsuario  | int(11) | NO   | MUL | NULL    |       |
        // | fecha      | date    | NO   |     | NULL    |       |
        // +------------+---------+------+-----+---------+-------+

        $sql3 = "SELECT u.nombreUsuario, s.nombreServicio, e.primerNombre, e.primerApellido, sc.fecha FROM serviciosCompletados sc INNER JOIN usuarios u ON sc.idUsuario = u.idUsuario INNER JOIN empleados e ON sc.idEmpleado = e.idEmpleado INNER JOIN servicios s ON sc.idServicio = s.idServicio";
        $result3 = $mysqli->query($sql3);
        if ($result3->num_rows > 0) {
            while ($row = $result3->fetch_assoc()) {
                $servicioCompletado = array(
                    "nombreUsuario" => $row["nombreUsuario"],
                    "nombreServicio" => $row["nombreServicio"],
                    "primerNombre" => $row["primerNombre"],
                    "primerApellido" => $row["primerApellido"],
                    "fecha" => $row["fecha"] ?? "No hay fecha"
                );
                array_push($serviciosCompletados, $servicioCompletado);
            }
        } else {
            
        }
    }
    ?>

    <nav>
        <div>
            <img src="/assets/logo-opengate.png" alt="logo" width="64" height="64">
            <h2>
                Bienvenido, <span><?php echo $nombreUsuario; ?></span>
            </h2>
        </div>
        <ul>
            <li>
                <a href="/cerrarSesion.php">Cerrar Sesión</a>
            </li>
        </ul>
    </nav>
    <main>
        <section>
            <!-- Una tabla para mostrar los empleados -->
            <table class="tablaEmpleados">
                <h3>
                    Empleados
                </h3>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de Nacimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($empleados as $empleado) {
                        echo "<tr>";
                        echo "<td>" . $empleado["primerNombre"] . "</td>";
                        echo "<td>" . $empleado["primerApellido"] . "</td>";
                        echo "<td>" . $empleado["fechaNacimiento"] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Una tabla para mostrar los servicios -->
            <table class="tablaServicios">
                <h3>
                    Servicios
                </h3>
                <thead>
                    <tr>
                        <th>Nombre del Servicio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($servicios as $servicio) {
                        echo "<tr>";
                        echo "<td>" . $servicio["nombreServicio"] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <section>
            <div>
                <h3>
                    Servicios Completados
                </h3>
                <table class="tablaServiciosCompletados">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Empleado</th>
                            <th>Servicio</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($serviciosCompletados as $servicioCompletado) {
                            echo "<tr>";
                            echo "<td>" . $servicioCompletado["nombreUsuario"] . "</td>";
                            echo "<td>" . $servicioCompletado["primerNombre"] . " " . $servicioCompletado["primerApellido"] . "</td>";
                            echo "<td>" . $servicioCompletado["nombreServicio"] . "</td>";
                            echo "<td>" . $servicioCompletado["fecha"] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div>
                <!-- Form para agregar mas servicios completados -->
                <form action="/agregarServicioCompletado.php" method="POST">
                    <h3>
                        Agregar Servicio Completado
                    </h3>
                    <div>
                        <label for="idUsuario">Usuario:</label>
                        <span>
                            <?php echo $nombreUsuario; ?>

                            <!-- Input hidden con el valor del id del usuario -->
                            <?php
                                $idUsuario;

                                $sql = "SELECT idUsuario FROM usuarios WHERE nombreUsuario = '$nombreUsuario'";
                                $result = $mysqli->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $idUsuario = $row["idUsuario"];
                                    }
                                }

                                echo "<input type='hidden' name='idUsuario' value='$idUsuario'>";
                            ?>
                        </span>
                    </div>
                    <div>
                        <label for="idEmpleado">Empleado:</label>
                        <!-- Optgroup -->
                        <select name="idEmpleado" id="idEmpleado">
                            <?php
                            foreach ($empleados as $empleado) {
                                echo "<option value='" . $empleado["idEmpleado"] . "'>" . $empleado["primerNombre"] . " " . $empleado["primerApellido"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="idServicio">Servicio:</label>
                        <!-- Optgroup -->
                        <select name="idServicio" id="idServicio">
                            <?php
                            foreach ($servicios as $servicio) {
                                echo "<option value='" . $servicio["idServicio"] . "'>" . $servicio["nombreServicio"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit">Agregar</button>
            </div>
        </section>
    </main>
</body>

</html>