<?php
session_start();
require_once "../Config/conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['usuario'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($pass, $row['password'])) {
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: ../index.php");
            exit();
        }
    }

    $error = "Usuario o contraseña incorrectos";
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
    <nav>
      <div class="logo">
        <a href="../index.php"><img src="../Assets/Images/icono.png" height="40" alt="logo"></a>
        <h1><a href="../index.php">MediaVault</a></h1>
      </div>

  <!-- Botón hamburguesa -->
      <button class="menu-toggle" id="menu-toggle">&#9776;</button>

  <!-- Menú -->
      <ul id="nav-links">
        <li><a href="../HTML/sobrenosotros.html">Sobre Nosotros</a></li>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../HTML/imagenes.html">Imagenes</a></li>
        <li><a href="../HTML/textos.html">Textos</a></li>
        <li><a href="../HTML/videos.html">Videos</a></li>
        <li><a href="./login.php">Iniciar Sesión</a></li>
      </ul>
    </nav>

  <!-- Script para togglear el menú -->
    <script src="../Scripts/navbar.js"></script>

    <main>
        <section class="login-container">
            <h2 style="text-align: center;">Iniciar Sesión</h2>
            <form method="POST" style="text-align: center;">
                <label for="Usuario">Usuario:</label>
                <input type="text" id="Usuario" name="Usuario" placeholder="Ingrese su usuario" required>
                <br>
                <label for="Contraseña">Contraseña:</label>
                <input type="password" id="Contraseña" name="Contraseña" placeholder="Ingrese su contraseña" required>
                <br>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 MediaVault. Renzo Gómez Terrussi.</p>
    </footer>
</body>
</html>