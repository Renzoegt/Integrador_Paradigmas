<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carga conexión
require dirname(__DIR__) . "/Config/conexion.php";

// Obtener tipo desde GET
$tipo = $_GET["tipo"] ?? null;

// Validación
$tipos_validos = ["imagen", "video", "texto"];
if (!$tipo || !in_array($tipo, $tipos_validos)) {
    echo "<h2>Error: tipo de contenido inválido.</h2>";
    exit();
}

// Consulta SQL
$sql = "SELECT * FROM contenido WHERE tipo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $tipo);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2 class="titulo-seccion">Contenido: <?= htmlspecialchars(ucfirst($tipo)) ?></h2>

<div class="content-grid">
    <?php while ($row = $result->fetch_assoc()): ?>
        <a href="../Templates/ver.php?id=<?= $row['id'] ?>" class="card-link">
        <div class="content-card">
            <h3><?= htmlspecialchars($row["nombre"]) ?></h3>

            <?php if ($row["tipo"] == "imagen"): ?>
                <img src="<?= $row["archivo"] ?: $row["url"] ?>" width="100%">
            <?php elseif ($row["tipo"] == "video"): ?>
                <video controls width="100%">
                    <source src="<?= $row["archivo"] ?: $row["url"] ?>">
                </video>
            <?php else: ?>
                <iframe width="100%" height="300"
                        src="<?= $row["archivo"] ?: $row["url"] ?>"></iframe>
            <?php endif; ?>

            <p><?= htmlspecialchars($row["descripcion"]) ?></p>

            <?php if ($row["usuario_id"] == $_SESSION["usuario_id"]): ?>
                <a href="../PHP/editar.php?id=<?= $row["id"] ?>">Editar</a>
                <a href="../PHP/borrar.php?id=<?= $row["id"] ?>">Borrar</a>
            <?php endif; ?>
        </div>
        </a>
    <?php endwhile; ?>
</div>