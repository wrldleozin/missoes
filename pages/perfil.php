<?php require_once '../php/db.php'; require_once '../php/functions.php'; requireLogin(); ?>
<!doctype html>
<html lang="pt-BR">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Perfil</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<header class="site-header">
    <div class="container">
      <h1>Missões do Dia</h1>
      <nav>
        <?php if(isLoggedIn()): ?>
          <a href="dashboard.php">Dashboard</a>
          <a href="mural.php">Mural</a>
          <a href="perfil.php">Perfil</a>
          <a href="logout.php">Sair</a>
        <?php else: ?>
          <a href="index.php">Início</a>
          <a href="login.php">Entrar</a>
          <a href="register.php">Criar conta</a>
          <a href="mural.php">Mural</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>
  <main class="container">
    <h2>Meu Perfil</h2>
    <p>Olá, <?= htmlspecialchars(getUserName($conn, $_SESSION['user_id'])) ?></p>
    <h3>Minhas missões</h3>
    <?php
    $stmt = $conn->prepare('SELECT texto, publico, criado_em FROM missoes WHERE id_usuario = ? ORDER BY criado_em DESC');
    $stmt->bind_param('i', $_SESSION['user_id']); $stmt->execute();
    $stmt->bind_result($texto, $publico, $criado_em);
    while ($stmt->fetch()) {
        $pub = $publico ? '(Compartilhada)' : '(Privada)';
        echo "<div class='card'><p>" . htmlspecialchars($texto) . "</p><p class='muted'>$pub — <small>$criado_em</small></p></div>";
    }
    $stmt->close();
    ?>
  </main>
</body>
</html>