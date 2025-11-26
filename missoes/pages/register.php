<?php require_once '../php/db.php'; require_once '../php/functions.php'; 
if (isLoggedIn()) header('Location: dashboard.php');

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    if ($nome && $email && $senha) {
        $stmt = $conn->prepare('SELECT id FROM usuarios WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email); $stmt->execute(); $stmt->store_result();
        if ($stmt->num_rows > 0) $erro = 'Email já cadastrado';
        else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $ins = $conn->prepare('INSERT INTO usuarios (nome,email,senha_hash) VALUES (?,?,?)');
            $ins->bind_param('sss', $nome, $email, $hash);
            if ($ins->execute()) { $_SESSION['user_id'] = $ins->insert_id; header('Location: dashboard.php'); exit; }
            else $erro = 'Erro ao cadastrar';
        }
    } else $erro = 'Preencha todos os campos';
}
?>
<!doctype html>
<html lang="pt-BR">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Cadastrar</title><link rel="stylesheet" href="../css/style.css"></head>
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
    <h2>Criar conta</h2>
    <?php if($erro): ?><div class="alert"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
    <form method="post">
      <label>Nome<input type="text" name="nome" required></label>
      <label>Email<input type="email" name="email" required></label>
      <label>Senha<input type="password" name="senha" required minlength="6"></label>
      <button class="btn-primary" type="submit">Criar conta</button>
    </form>
    <p>Já tem conta? <a href="login.php">Entrar</a></p>
  </main>
</body>
</html>