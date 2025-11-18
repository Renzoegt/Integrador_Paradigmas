<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ficciones de Jorge Luis Borges</title>
  <link rel="stylesheet" href="../../Styles/Style.css">
  <link rel="icon" type="image/x-icon" href="../../Assets/Images/icono.png">
</head>
<body class="pagina pagina-textos">
  <!-- Navbar -->
  <?php include "../Assets/Templates/Componentes/navbar.php"; ?>
  
  <main>
    <h1>Borges - Ficciones</h1>
    <div id="Contenedor-de-texto" class="content-grid"></div>
  </main>
  
  <!-- Footer -->
    <footer>
        <p>&copy; 2025 MediaVault. Renzo Gómez Terrussi.</p>
    </footer>

  <script src="../../Scripts/ContentRender.js"></script>
  <script>
    // Llamar al render dinámico para textos
    renderContent("Contenedor-de-texto", "textos");
  </script>
</body>
</html>