<?php require_once '../php/db.php'; require_once '../php/functions.php'; 
if (isLoggedIn()) header('Location: dashboard.php');

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    if ($email && $senha) {
        $stmt = $conn->prepare('SELECT id, senha_hash FROM usuarios WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        if ($res && password_verify($senha, $res['senha_hash'])) {
            $_SESSION['user_id'] = $res['id'];
            header('Location: dashboard.php'); exit;
        }
    }
    $erro = 'Email ou senha inválidos';
}
?>
<!doctype html>
<html lang="pt-BR">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Entrar</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<header class="site-header">
    <nav class="nav-container">
        <div class="nav-left">
            <img src="../imgs/logo.png" class="nav-logo" alt="Logo">
            <span class="nav-title">Missões</span>
        </div>

        <div class="nav-links">
            <a href="index.php" class="nav-item">Início</a>
            <a href="login.php" class="nav-item">Entrar</a>
            <a href="register.php" class="nav-item">Registrar</a>
        </div>
    </nav>
</header>
  <main class="auth">
    <h2>Entrar</h2>
    <?php if($erro): ?><div class="alert"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
    <form method="post">
      <label>Email<input type="email" name="email" required></label>
      <label>Senha<input type="password" name="senha" required></label>
      <button class="btn-primary" type="submit">Entrar</button>
    </form>
    <p>Não tem conta? <a href="register.php">Criar conta</a></p>
  </main>
</body>
</html>