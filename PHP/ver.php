<?php
session_start();
require_once "../Config/conexion.php";

if (!isset($_GET["id"])) {
    die("Contenido no especificado.");
}

$id = intval($_GET["id"]);

// Consulta del contenido
$sql = "SELECT c.*, u.username AS usuario_nombre
        FROM contenido c
        INNER JOIN usuarios u ON c.usuario_id = u.id
        WHERE c.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item) {
    die("Contenido no encontrado.");
}

// Datos
$tipo      = $item["tipo"];
$archivo   = $item["archivo"];
$url       = $item["url"];
$nombre    = $item["nombre"];
$descripcion = $item["descripcion"];
$miniatura = $item["miniatura"];
$usuario_subio = $item["usuario_nombre"];
$es_dueno  = isset($_SESSION["id"]) && $_SESSION["id"] == $item["usuario_id"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $nombre ?> - MediaVault</title>
    <link rel="stylesheet" href="../Styles/Style.css">
</head>
<?php if ($tipo === "imagen"): ?>
    <body class="pagina pagina-imagenes">
        <!-- Navbar -->
        <?php include "../Assets/Templates/Componentes/navbar.php"; ?>
        
        <main>
            <h1><?= $nombre ?></h1>
            <p><strong>Subido por:</strong> <?= $usuario_subio ?></p>
            <hr>
            <div id="Contenedor-de-imagen" class="content-grid">
                <article class="content-card">
                    <?php if ($archivo): ?>
                        <img src="<?= $archivo ?>" alt="<?= $nombre ?>">
                    <?php elseif ($url): ?>
                       <img src="<?= $url ?>" alt="<?= $nombre ?>">
                    <?php else: ?>
                        <p>No hay archivo disponible.</p>
                    <?php endif; ?>
                    <h3><?= $nombre ?></h3>
                    <p><?= $descripcion ?></p>
                </article>
            </div>
        </main>
        <!-- Botones si el usuario es dueño -->
        <?php if ($es_dueno): ?>
            <hr>
            <a href="editar.php?id=<?= $id ?>" class="btn-editar">Editar</a>
            <a href="eliminar.php?id=<?= $id ?>" class="btn-eliminar" onclick="return confirm('¿Eliminar este contenido?')">Eliminar</a>
        <?php endif; ?>
        <!-- Footer -->
        <footer>
            <p>&copy; 2025 MediaVault. Renzo Gómez Terrussi.</p>
        </footer>
    </body>

<?php elseif ($tipo === "video"): ?>
    <body class="pagina pagina-textos">
        <!-- Navbar -->
        <?php include "../Assets/Templates/Componentes/navbar.php"; ?>
        
        <main>
            <h1><?= $nombre ?></h1>
            <p><strong>Subido por:</strong> <?= $usuario_subio ?></p>
            <hr>
            <div id="Contenedor-de-video" class="content-grid">
                <article class="content-card">
                    <h3><?= $nombre ?></h3>
                    <?php if ($archivo): ?>
                        <video controls="" autoplay="" width="100%" name=><source src="<?= $archivo ?>" type="video/mp4"></video>
                    <?php elseif ($url): ?>
                            <iframe src="<?= $url ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" frameborder="0" style="width: 100%; height:25rem;" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <?php else: ?>
                        <p>No hay archivo disponible.</p>
                    <?php endif; ?>
                    <p><?= $descripcion ?></p>
                </article>
            </div>
        </main>
        <!-- Botones si el usuario es dueño -->
        <?php if ($es_dueno): ?>
            <hr>
            <a href="editar.php?id=<?= $id ?>" class="btn-editar">Editar</a>
            <a href="eliminar.php?id=<?= $id ?>" class="btn-eliminar" onclick="return confirm('¿Eliminar este contenido?')">Eliminar</a>
        <?php endif; ?>
        <!-- Footer -->
        <footer>
            <p>&copy; 2025 MediaVault. Renzo Gómez Terrussi.</p>
        </footer>
    </body>
<?php elseif ($tipo === "texto"): ?>
    <body class="pagina pagina-textos">
        <!-- Navbar -->
        <?php include "../Assets/Templates/Componentes/navbar.php"; ?>
        
        <main>
            <h1><?= $nombre ?></h1>
            <p><strong>Subido por:</strong> <?= $usuario_subio ?></p>
            <hr>
            <div id="Contenedor-de-texto" class="content-grid">
                <article class="content-card">
                    <h3><?= $nombre ?></h3>
                    <?php if ($archivo): ?>
                        <iframe src="<?= $archivo ?>" frameborder="0" width="100%" height="600px" alt="<?= $nombre ?>" allowfullscreen></iframe>
                    <?php elseif ($url): ?>
                        <iframe src="<?= $url ?>" frameborder="0" width="100%" height="600px" alt="<?= $nombre ?>" allowfullscreen></iframe>
                    <?php else: ?>
                        <p>No hay archivo disponible.</p>
                    <?php endif; ?>
                    <p><?= $descripcion ?></p>
                </article>
            </div>
        </main>
        <!-- Botones si el usuario es dueño -->
        <?php if ($es_dueno): ?>
            <hr>
            <a href="editar.php?id=<?= $id ?>" class="btn-editar">Editar</a>
            <a href="eliminar.php?id=<?= $id ?>" class="btn-eliminar" onclick="return confirm('¿Eliminar este contenido?')">Eliminar</a>
        <?php endif; ?>
        <!-- Footer -->
        <footer>
            <p>&copy; 2025 MediaVault. Renzo Gómez Terrussi.</p>
        </footer>
    </body>
<?php endif; ?>
</html>

