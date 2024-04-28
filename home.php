<?php
session_start();

// Checks if the user has logged in, if not it will redirect to the login page
if (!isset($_SESSION['nombreUsuario'])) {
    header("Location: /");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/home.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <h2>
            Bienvenido,<span><?php echo $_SESSION['nombreUsuario']; ?></span>
        </h2>
        <ul>
            <li>
                <a href="/cerrarSesion.php">Cerrar Sesión</a>
            </li>
        </ul>
    </nav>
</body>

</html>