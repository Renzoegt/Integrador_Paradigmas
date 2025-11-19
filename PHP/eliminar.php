<?php
    session_start();
    require_once "../Config/conexion.php";

    if (!isset($_GET["id"])) {
        die("ID no especificado.");
    }

    $id = intval($_GET["id"]);

    // Obtener el contenido
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
        die("No tenés permiso para eliminar este contenido.");
    }

    // Eliminar archivos físicos
    if (!empty($item["archivo"]) && file_exists($item["archivo"])) {
        unlink($item["archivo"]);
    }

    if (!empty($item["miniatura"]) && file_exists($item["miniatura"])) {
        unlink($item["miniatura"]);
    }

    // Eliminar de BD
    $del = $conn->prepare("DELETE FROM contenido WHERE id = ?");
    $del->bind_param("i", $id);
    $del->execute();

    header("Location: ../index.php?msg=eliminado");
    exit();
?>
