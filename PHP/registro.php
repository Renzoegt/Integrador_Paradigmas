<?php
require "../Config/conexion.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST["Usuario"];
    $pass = password_hash($_POST["Contraseña"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);

    if ($stmt->execute()) {
        echo "Usuario creado correctamente. <a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediaVault - Iniciar Sesión</title>
    <link rel="icon" type="image/x-icon" href="../Assets/Images/icono.png">
    <link rel="stylesheet" href="../Styles/Style.css">
</head>
<body>
    <?php include "../Assets/Templates/Componentes/navbar.php"; ?>
    <main>
        <section class="login-container">
            <h2 style="text-align: center;">Registrarse</h2>
            <form method="POST" style="text-align: center;">
                <label for="Usuario">Usuario:</label>
                <input type="text" id="Usuario" name="Usuario" placeholder="Ingrese su usuario" required>
                <br>
                <label for="Contraseña">Contraseña:</label>
                <input type="password" id="Contraseña" name="Contraseña" placeholder="Ingrese su contraseña" required>
                <br>
                <button type="submit"> Registrarse </button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 MediaVault. Renzo Gómez Terrussi.</p>
    </footer>
</body>
</html>