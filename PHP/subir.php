<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediaVault - Subir Contenido</title>
    <link rel="icon" type="image/x-icon" href="../Assets/Images/icono.png">
    <link rel="stylesheet" href="../Styles/Style.css">
</head>
<body>
    <!-- Navbar -->
    <?php include "../Assets/Templates/Componentes/navbar.php"; ?>
  
    <main>
        <section class="login-container">
            <h2 style="text-align:center;">Subir Contenido</h2>

            <form action="./enviar.php" method="POST" enctype="multipart/form-data" style="text-align:center;">
                <label for="nombre">Ingrese el nombre del archivo</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre del archivo" required>
                <br>
                <!-- selector de tipo -->
                <label for="tipo">Tipo de contenido:</label>
                <select name="tipo" id="tipo" required>
                    <option value="imagen">Imagen</option>
                    <option value="video">Video</option>
                    <option value="texto">Texto / PDF</option>
                </select>
                <br>
                <label for="descripcion">Ingrese una descripción</label>
                <input type="text" name="descripcion" id="descripcion" placeholder="Ingrese una descripcion" required>
                <br>
                <label>Seleccione archivo:</label>
                <input type="file" name="archivo">
                <br>

                <label>O ingrese una URL:</label>
                <input type="text" name="url" placeholder="https://...">
                <br>
                <button type="submit">Subir</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 MediaVault. Renzo Gómez Terrussi.</p>
    </footer>
</body>
</html>