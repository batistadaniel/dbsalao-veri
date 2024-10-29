<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
?>

<main>
    <?php if ($tipo_usuario == 'administrador'): ?>
        <section id="admin-section">
            <h2>Área do Administrador</h2>
            <!-- Funcionalidades exclusivas do administrador -->
        </section>
    <?php endif; ?>

    <?php if ($tipo_usuario == 'funcionario'): ?>
        <section id="funcionario-section">
            <h2>Área do Funcionário</h2>
            <!-- Funcionalidades exclusivas do funcionário -->
        </section>
    <?php endif; ?>

    <?php if ($tipo_usuario == 'cliente'): ?>
        <section id="cliente-section">
            <h2>Área do Cliente</h2>
            <!-- Funcionalidades exclusivas do cliente -->
        </section>
    <?php endif; ?>
</main>
