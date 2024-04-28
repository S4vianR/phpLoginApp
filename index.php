<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/index.css">
    <title>Document</title>
</head>

<body>
    <?php
    // Traernos el nombreUsuario y password
    $nombreUsuario = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    // Ref the user to the home page
    if ($nombreUsuario === "admin" && $password === "admin") {
        session_start();
        $_SESSION['nombreUsuario'] = $nombreUsuario;
        header("Location: home.php");
    }
    ?>

    <form action="." method="post">
        <h2>Login user app</h2>
        <div>
            <!-- nombreUsuario -->
            <label for="nombreUsuario">Nombre de usuario:</label>
            <input type="text" name="nombreUsuario" id="nombreUsuario">
        </div>
        <div>
            <!-- contraseña -->
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password">
        </div>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>

</html>