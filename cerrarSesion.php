<?php
if (!session_start()) {
    session_unset();
    // Destroy the session on the browser
    setcookie(session_name(), "", time() - 3600);
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/cerrarSesion.css">
    <title>Document</title>
</head>

<body>
    <h3 id="tituloCerrarSesion"></h3>
</body>

<script defer>
    const tituloCerrarSesion = document.getElementById("tituloCerrarSesion");
    setTimeout(() => {
        tituloCerrarSesion.textContent = "Sesión cerrada.";
    }, 500);

    setTimeout(() => {
        tituloCerrarSesion.textContent = "Sesión cerrada..";
    }, 1500);

    setTimeout(() => {
        tituloCerrarSesion.textContent = "Sesión cerrada...";
    }, 2000);

    setTimeout(() => {
        window.location.href = "/";
    }, 2500);
</script>

</html>