<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cargar conexión
require dirname(__DIR__) . "/Config/conexion.php";

// Si la variable $tipo NO está definida en la página que incluye el render,
// entonces mostramos todo.
$filtrar_por_tipo = false;
if (isset($tipo) && !empty($tipo)) {
    $filtrar_por_tipo = true;
}

// PREPARAR CONSULTA
if ($filtrar_por_tipo) {
    $sql = "SELECT * FROM contenido WHERE tipo = ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tipo);
} else {
    $sql = "SELECT * FROM contenido ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<div class="content-grid">
    <?php if ($result->num_rows === 0): ?>
        <p>No hay contenido cargado todavía.</p>
    <?php endif; ?>

    <?php while ($row = $result->fetch_assoc()): ?>

        <a href="../Templates/ver.php?id=<?= $row['id'] ?>" class="card-link">

        <div class="content-card">
            <h3><?= htmlspecialchars($row["nombre"]) ?></h3>

            <?php
            // Determinar ruta final del archivo
            $ruta = !empty($row["archivo"]) ? $row["archivo"] : $row["url"];
            ?>

            <?php if ($row["tipo"] === "imagen"): ?>

                <img src="<?= $ruta ?>" style="width:100%; border-radius:8px;">

            <?php elseif ($row["tipo"] === "video"): ?>

                <video controls style="width:100%; border-radius:8px;">
                    <source src="<?= $ruta ?>">
                </video>

            <?php elseif ($row["tipo"] === "texto"): ?>

                <iframe src="<?= $ruta ?>" style="width:100%; height:300px; border:1px solid #ccc;"></iframe>

            <?php else: ?>

                <p>Tipo desconocido.</p>

            <?php endif; ?>

            <p><?= nl2br(htmlspecialchars($row["descripcion"])) ?></p>

            <?php if (isset($_SESSION["usuario_id"]) && $row["usuario_id"] == $_SESSION["usuario_id"]): ?>
                <a href="../PHP/editar.php?id=<?= $row["id"] ?>">Editar</a>
                <a href="../PHP/borrar.php?id=<?= $row["id"] ?>">Borrar</a>
            <?php endif; ?>
        </div>
        </a>

    <?php endwhile; ?>
</div>
