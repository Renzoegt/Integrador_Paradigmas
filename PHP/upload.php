<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

require "config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_FILES['archivo']['name'];
    $ruta = "uploads/" . basename($nombre);
    $tipo = $_FILES['archivo']['type'];

    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta)) {
        $sql = "INSERT INTO archivos (nombre, ruta, tipo, usuario_id) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $ruta, $tipo, $_SESSION['usuario_id']);
        $stmt->execute();

        echo "Archivo subido correctamente.";
    } else {
        echo "Error al subir archivo.";
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="archivo" required>
    <button type="submit">Subir</button>
</form>
