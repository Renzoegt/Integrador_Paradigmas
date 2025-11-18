<?php
session_start();
require_once "./Config/conexion.php";

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
            header("Location: index.php");
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
    <title>MediaVault - Home</title>
    <link rel="icon" type="image/x-icon" href="./Assets/Images/icono.png">
    <link rel="stylesheet" href="Styles/Style.css">
</head>
<body>
  <!-- Menú -->
    <?php include "./Assets/Templates/Componentes/navbar.php"; ?>

  <!-- Principales Colecciones -->
    <section class="collections">
        <h2>Colecciones en Tendencia</h2>
        <div class="grid">
        <div id="textos" class="column"></div>
        <div id="videos" class="column"></div>
        <div id="imagenes" class="column"></div>
        </div>
    </section>
    
  <!-- renderizado de contenido-->
  <?php include "./PHP/render.php"; ?>
  <!-- Footer -->
  <footer>
    <p>&copy; 2025 MediaVault. Renzo Gómez Terrussi.</p>
  </footer>
</body> 
</html>