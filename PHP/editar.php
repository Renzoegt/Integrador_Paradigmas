<?php
session_start();
require_once "../Config/conexion.php";

if (!isset($_GET["id"])) {
    die("ID no especificado.");
}

$id = intval($_GET["id"]);

// Obtener datos del contenido
$sql = "SELECT * FROM contenido WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item) {
    die("Contenido no encontrado.");
}

if (!isset($_SESSION["id"]) || $_SESSION["id"] != $item["usuario_id"]) {
    die("No tenés permiso para editar este contenido.");
}

$mensaje = "";

// PROCESAR FORMULARIO
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $url = $_POST["url"];

    $archivo = $item["archivo"];
    $miniatura = $item["miniatura"];

    // Procesar nuevo archivo (si lo suben)
    if (!empty($_FILES["archivo"]["name"])) {
        $ruta = "../Assets/Uploads/" . time() . "_" . basename($_FILES["archivo"]["name"]);
        move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta);

        // borrar archivo anterior
        if ($archivo && file_exists($archivo)) {
            unlink($archivo);
        }

        $archivo = $ruta;
    }

    // Procesar nueva miniatura
    if (!empty($_FILES["miniatura"]["name"])) {
        $rutaMini = "../Assets/Miniaturas/" . time() . "_" . basename($_FILES["miniatura"]["name"]);
        move_uploaded_file($_FILES["miniatura"]["tmp_name"], $rutaMini);

        if ($miniatura && file_exists($miniatura)) {
            unlink($miniatura);
        }

        $miniatura = $rutaMini;
    }

    // Actualizar BD
    $upd = $conn->prepare("
        UPDATE contenido SET 
            nombre = ?, 
            descripcion = ?, 
            url = ?, 
            archivo = ?, 
            miniatura = ?
        WHERE id = ?
    ");

    $upd->bind_param("sssssi", $nombre, $descripcion, $url, $archivo, $miniatura, $id);
    $upd->execute();

    $mensaje = "Contenido actualizado correctamente.";
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Editar - <?= $item['nombre'] ?></title>
        <link rel="stylesheet" href="../Styles/Style.css">
    </head>
    <body class="pagina pagina-textos">

        <?php include "../Assets/Templates/Componentes/navbar.php"; ?>
        <main>
            <section class="login-container">
                <h2 style="text-align:center;">Editar contenido</h2>
                <?php if ($mensaje): ?>
                    <p class="mensaje-exito"><?= $mensaje ?></p>
                <?php endif; ?>

                <form action="" method="POST" enctype="multipart/form-data" class="form-editar">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="<?= $item['nombre'] ?>" required>
                    <br>
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" required><?= $item['descripcion'] ?></textarea>
                    <br>
                    <label for="url">URL externa (opcional)</label>
                    <input type="text" name="url" value="<?= $item['url'] ?>">
                    <br>
                    <label for="archivo">Subir nuevo archivo (opcional):</label>
                    <input type="file" name="archivo" id="archivo">
                    <br>
                    <label for="miniatura">Subir nueva miniatura (opcional):</label>
                    <input type="file" name="miniatura" id="miniatura">
                    <br>
                    <button type="submit" class="btn-editar">Guardar cambios</button>
                </form>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 MediaVault. Renzo Gómez Terrussi.</p>
        </footer>

    </body>
</html>
