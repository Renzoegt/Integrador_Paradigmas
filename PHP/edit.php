<?php
session_start();
require "../Config/conexion.php";

$id = $_GET["id"];
$archivo = $conn->query("SELECT * FROM archivos WHERE id = $id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nuevoNombre = $_POST["nombre"];

    $sql = "UPDATE archivos SET nombre = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nuevoNombre, $id);

    $stmt->execute();

    header("Location: ../index.php");
    exit();
}
?>
<form method="POST">
    <input type="text" name="nombre" value="<?= $archivo['nombre'] ?>" required>
    <button type="submit">Guardar</button>
</form>
