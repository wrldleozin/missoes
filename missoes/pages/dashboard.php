<?php require_once '../php/db.php'; require_once '../php/functions.php'; requireLogin(); 
$user_id = $_SESSION['user_id'];
$missoes = [
    'Elogie alguém hoje.',
    'Doe algo que você não usa mais.',
    'Envie uma mensagem positiva para um amigo.',
    'Faça algo gentil por um estranho.',
    'Tire 10 minutos para meditar ou respirar profundamente.',
    'Escreva uma frase motivadora e compartilhe.',
    'Agradeça alguém pelo que fez de bom hoje.',
    'Sorria para alguém desconhecido.',
    'Entregue uma flor para alguém',
    'Elogie duas pessoas hoje',
    'Alimente um sem teto',
    'Doe para alguem.',
    'Ajude alguém a carregar algo pesado.',
    'Segure a porta para outra pessoa.',
    'Envie uma mensagem de agradecimento para alguém especial.',
    'Ofereça ajuda a um colega que esteja com dificuldades.',
    'Compartilhe um vídeo ou frase motivadora com um amigo.',
    'Escreva três coisas pelas quais você é grato hoje.',
    'Faça um pequeno favor sem esperar nada em troca.',
    'Recolha um lixo que não é seu e jogue no lugar certo.',
    'Pergunte a alguém como ela está – e ouça de verdade.',
    'Dê um incentivo a alguém que está desanimado.',
    'Faça um elogio sincero para um familiar.',
    'Motive alguém que esteja começando algo novo.',
    'Ajude um idoso a atravessar a rua ou carregar sacolas.',
    'Doe 1 real ou mais para alguém que precisa.',
    'Faça um desenho ou bilhete fofo e entregue para alguém.',
    'Apoie um pequeno comércio local comprando algo.',
    'Prepare um café ou lanche para alguém especial.',
    'Ofereça carona ou acompanhe alguém até um destino.',
    'Compartilhe conhecimento útil com outra pessoa.',
    'Diga a alguém que você acredita nela.',
    'Faça um gesto de carinho para alguém da sua família.',
    'Escreva uma mensagem encorajadora para você mesmo no futuro.',
    'Ajude um colega a organizar algo ou resolver um problema.',
    'Reflita sobre algo que você aprendeu recentemente.',
    'Peça desculpas a alguém se necessário.',
    'Perdoe alguém internamente, mesmo que em silêncio.',
    'Tire um tempo para respirar fundo e relaxar por 3 minutos.',
    'Pratique um ato de bondade anônimo.',
    'Faça alguém rir hoje.',
    'Envie uma música que você gosta para um amigo.',
    'Agradeça alguém que trabalha em serviços públicos (como motorista ou atendente).',
    'Observe o céu por alguns minutos e aprecie o momento.',
    'Pague um café ou lanche para alguém.',
    'Ofereça seu lugar para alguém em transporte público.',
    'Ajude alguém a estudar ou aprender algo.',
    'Faça uma doação de alimentos, roupas ou itens de higiene.',
    'Dê bom dia com um sorriso para 3 pessoas.',
    'Diga algo positivo para você mesmo diante do espelho.',
    'Compartilhe uma boa notícia com alguém.',
    'Faça um gesto inesperado de gentileza hoje.'
];
$missao_hoje = $missoes[array_rand($missoes)];
?>
<!doctype html>
<html lang="pt-BR">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Dashboard</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<header class="site-header">
    <div class="nav-container">
        <div class="nav-left">
            <img src="../imgs/logo.png" alt="Logo" class="nav-logo">
            <span class="nav-title">Missões do Dia</span>
        </div>

        <nav class="nav-links">
            <?php if(isLoggedIn()): ?>
                <a href="dashboard.php" class="nav-item">Dashboard</a>
                <a href="mural.php" class="nav-item">Mural</a>
                <a href="perfil.php" class="nav-item">Perfil</a>
                <a href="logout.php" class="nav-btn">Sair</a>
            <?php else: ?>
                <a href="index.php" class="nav-item">Início</a>
                <a href="login.php" class="nav-item">Entrar</a>
                <a href="register.php" class="nav-item">Criar conta</a>
                <a href="mural.php" class="nav-item">Mural</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
  <main class="container">
    <h2>Olá, <?= htmlspecialchars(getUserName($conn, $user_id)) ?> — sua missão do dia</h2>
    <div class="card"><p id="missao"><?= htmlspecialchars($missao_hoje) ?></p></div>
    <form method="post" action="compartilhar.php">
    <label for="experiencia" style="font-weight:600; color:#374151; margin-bottom:6px; display:block;">
        Como foi sua experiência realizando esta missão?
    </label>
    <textarea
        name="experiencia"
        id="experiencia"
        rows="4"
        placeholder="Conte como foi fazer essa missão hoje..."
        required
        style="
            width:100%;
            padding:14px;
            border-radius:14px;
            border:1px solid #d1d5db;
            margin-top:6px;
            margin-bottom:16px;
            resize: vertical;
            font-size:15px;
            box-shadow:0 4px 10px rgba(0,0,0,0.04);
        "
    ></textarea>

      <input type="hidden" name="texto" value="<?= htmlspecialchars($missao_hoje) ?>">
      <button class="btn-primary" type="submit">Compartilhar no Mural</button>
    </form>
    <p style="margin-top:18px"><a href="mural.php">Ver mural público</a></p>
  </main>
</body>
</html>