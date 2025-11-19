<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require "../Config/conexion.php";

if (!isset($_SESSION["id"])) {
    die("Debes iniciar sesión para subir contenido.");
}

$usuario_id = $_SESSION["id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $tipo = $_POST["tipo"]; 
    $url = $_POST["url"] ?? null;

    $ruta_archivo = null;
    $miniatura = null;

    // Subida de archivo
    if (!empty($_FILES["archivo"]["name"])) {
        $archivo = $_FILES["archivo"];
        $nombreArchivo = time() . "_" . basename($archivo["name"]);
        $ruta_archivo = "../Assets/Uploads/" . $nombreArchivo;

        if (!move_uploaded_file($archivo["tmp_name"], $ruta_archivo)) {
            die("Error al subir el archivo.");
        }
    }

    // Subida de miniatura
    if (!empty($_FILES["miniatura"]["name"])) {
        $miniatura = $_FILES["miniatura"];
        $nombreThumb = time() . "_thumb_" . basename($miniatura["name"]);
        $ruta_miniatura = "../Assets/Miniaturas/" . $nombreThumb;

        if (move_uploaded_file($miniatura["tmp_name"], $ruta_miniatura)) {
            $miniatura = $ruta_miniatura;
        } else {
            die("Error al subir la miniatura.");
        }
    }
    // Validación: debe haber archivo o URL
    if (!$ruta_archivo && !$url) {
        die("Debes subir un archivo o ingresar una URL.");
    }

    // Guardar en BD
    $sql = "INSERT INTO contenido (nombre, descripcion, archivo, url, miniatura, tipo, usuario_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nombre, $descripcion, $ruta_archivo, $url, $miniatura, $tipo, $usuario_id);
    if ($stmt->execute()) {
        echo "Contenido subido correctamente. <a href='./subir.php'>Volver</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
