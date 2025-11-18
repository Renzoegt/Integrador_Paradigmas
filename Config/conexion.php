<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "mediavault";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8");
?>
