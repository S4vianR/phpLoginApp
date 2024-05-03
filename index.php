<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="icon" type="image/png" href="/assets/logo-opengate.png">
    <title>Login</title>
</head>

<body>
    <?php
    // Se incluye el archivo de conexión a la base de datos
    include_once "conexion.php";
    
    session_start();

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombreUsuario = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : "";
        $password = isset($_POST['password']) ? $_POST['password'] : "";


        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        } else {
            // Consulta para verificar si el usuario existe y las credenciales son válidas
            $sqlQuery = "SELECT * FROM usuarios WHERE nombreUsuario = '$nombreUsuario' AND passwd = '$password'";
            $result = $mysqli->query($sqlQuery);

            if ($result && $result->num_rows > 0) {
                $_SESSION['nombreUsuario'] = $nombreUsuario; // Iniciar sesión solo si las credenciales son válidas
                header("Location: home.php");
                exit; // Asegúrate de llamar a exit después de una redirección
            } else {
                // Mostrar un mensaje de error si las credenciales son inválidas
                echo "<h3>Usuario o contraseña incorrectos</h3>";
            }
        }
    }
    ?>

    <form action="index.php" method="post">
        <h2>Login user app</h2>
        <div>
            <!-- nombreUsuario -->
            <label for="nombreUsuario">Nombre de usuario:</label>
            <input type="text" name="nombreUsuario" id="nombreUsuario" placeholder="Nombre de usuario" max="50" required>
        </div>
        <div>
            <!-- contraseña -->
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" min="4" max="25" placeholder="Contraseña" required>
        </div>
        <button type="submit">Iniciar</button>
        <a href="registro.php">¿No tienes cuenta? Regístrate</a>
    </form>
</body>