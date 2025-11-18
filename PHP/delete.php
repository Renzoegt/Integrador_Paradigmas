<?php
session_start();
require "../Config/conexion.php";

$id = $_GET["id"];
$conn->query("DELETE FROM archivos WHERE id = $id");

header("Location: index.php");
