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
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: index.php");
            exit();
        }
    }

    $error = "Usuario o contraseña incorrectos";
}

$items = [
    "texto" => [],
    "video" => [],
    "imagen" => []
];

$sql = "SELECT c.*, u.username AS usuario_nombre
        FROM contenido c
        INNER JOIN usuarios u ON c.usuario_id = u.id
        ORDER BY c.tipo, c.fecha DESC";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tipo = $row["tipo"];
        $items[$tipo][] = $row;
    }
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
        <h2>Bienvenido a MediaVault</h2>
        <h3>Explora nuestras colecciones principales</h3>
        <div class="grid">
        <div id="textos" class="column">
            <?php foreach ($items["texto"] ?? [] as $i): ?>
                <div class="card">
                <a href="./PHP/ver.php?id=<?= $i['id'] ?>">
                    <img src="PHP/<?= $i['miniatura'] ?>" class="miniatura">
                    <h3><?= $i['nombre'] ?></h3>
                    <p>Subido por: <?= $i['usuario_nombre'] ?></p>
                </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div id="videos" class="column">
            <?php foreach ($items["video"] ?? [] as $i): ?>
                <div class="card">
                <a href="./PHP/ver.php?id=<?= $i['id'] ?>">
                    <img src="PHP/<?= $i['miniatura'] ?>" class="miniatura">
                    <h3><?= $i['nombre'] ?></h3>
                    <p>Subido por: <?= $i['usuario_nombre'] ?></p>
                </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div id="imagenes" class="column">
            <?php foreach ($items["imagen"] ?? [] as $i): ?>
                <div class="card">
                <a href="./PHP/ver.php?id=<?= $i['id'] ?>">
                    <img src="PHP/<?= $i['miniatura'] ?>" class="miniatura">
                    <h3><?= $i['nombre'] ?></h3>
                    <p>Subido por: <?= $i['usuario_nombre'] ?></p>
                </a>
                </div>
            <?php endforeach; ?>
        </div>
        </div>
    </section>
  <footer>
    <p>&copy; 2025 MediaVault. Renzo Gómez Terrussi.</p>
  </footer>
</body> 
</html>