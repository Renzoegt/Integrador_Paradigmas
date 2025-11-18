<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav>
    <div class="logo">
        <a href="/Integrador_Paradigmas/index.php">
            <img src="/Integrador_Paradigmas/Assets/Images/icono.png" height="40" alt="logo">
        </a>
        <h1><a href="/Integrador_Paradigmas/index.php">MediaVault</a></h1>
    </div>

    <!-- Botón hamburguesa -->
    <button class="menu-toggle" id="menu-toggle">&#9776;</button>

    <!-- Menú -->
    <ul id="nav-links">
        <li><a href="/Integrador_Paradigmas/PHP/sobrenosotros.php">Sobre Nosotros</a></li>
        <li><a href="/Integrador_Paradigmas/index.php">Home</a></li>
        <li><a href="/Integrador_Paradigmas/PHP/imagenes.php">Imagenes</a></li>
        <li><a href="/Integrador_Paradigmas/PHP/textos.php">Textos</a></li>
        <li><a href="/Integrador_Paradigmas/PHP/videos.php">Videos</a></li>
        <?php if (isset($_SESSION["usuario"])): ?>

            <!-- Mostrar nombre del usuario -->
            <li>
                <?= htmlspecialchars($_SESSION["usuario"]) ?>
            </li>

            <!-- Opción: Subir contenido -->
            <li><a href="/Integrador_Paradigmas/PHP/subir.php">Subir contenido</a></li>

            <!-- Botón de logout -->
            <li><a href="/Integrador_Paradigmas/PHP/logout.php">Cerrar Sesión</a></li>

        <?php else: ?>

            <!-- Botón login -->
            <li><a href="/Integrador_Paradigmas/PHP/login.php">Iniciar Sesión</a></li>

        <?php endif; ?>
    </ul>
</nav>

<script src="/Integrador_Paradigmas/Scripts/navbar.js"></script>