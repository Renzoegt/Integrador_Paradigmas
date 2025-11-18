<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediaVault - Imagenes</title>
    <link rel="icon" type="image/x-icon" href="../Assets/Images/icono.png">
    <link rel="stylesheet" href="../Styles/Style.css">
</head>
<body>
  <!-- Navbar -->
    <?php include "../Assets/Templates/Componentes/navbar.php"; ?>
  
  <!-- Principales Colecciones -->
    <section class="collections">
        <h2>Colecciones de Imagenes en Tendencia</h2>
        <div class="ind-grid" id="imagenes">
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 MediaVault. Renzo Gómez Terrussi.</p>
    </footer>
    <!-- Script Externo-->
    <script src="../Scripts/CardsRender.js"></script>
</body>
</html>