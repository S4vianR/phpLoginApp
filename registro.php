<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/registro.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/logo-opengate.png">
    <title>Registro</title>
</head>

<body>
    <?php
    // Traernos el nombreUsuario y password
    $nombreUsuario = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $passwordRepeat = isset($_POST['passwordRepeat']) ? $_POST['passwordRepeat'] : "";

    // Se incluye el archivo de conexión a la base de datos
    include_once "conexion.php";

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        if ($nombreUsuario === "" || $password === "" || $passwordRepeat === "") {
            echo "<h3>Por favor, rellena todos los campos</h3>";
        } else {
            if ($password === $passwordRepeat) {
                // Insert the user into the database
                $sql = "INSERT INTO usuarios (nombreUsuario, passwd) VALUES ('$nombreUsuario', '$password')";
                if ($mysqli->query($sql) === TRUE) {
                    // Close the connection
                    $mysqli->close();
                    echo "<script> alert('Usuario registrado exitosamente');</script>";
                    // Redirect to the login page
                    header("Location: index.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                }
            } else {
                echo "<h3>Error: Las contraseñas no coinciden</h3>";
            }
        }
    }
    ?>

    <form action="registro.php" method="post">
        <h2>Registrar usuario</h2>
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
        <div>
            <!-- Repetir contraseña -->
            <label for="passwordRepeat">Repetir contraseña:</label>
            <input type="password" name="passwordRepeat" id="passwordRepeat" min="4" max="25" placeholder="Repetir contraseña" required>
        </div>
        <button type="submit">Registrarte</button>
        <a href="index.php">Ya tienes cuenta? Accede aquí!!!</a>
    </form>
</body>

</html>