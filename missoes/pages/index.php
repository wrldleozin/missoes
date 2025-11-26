<?php require_once '../php/db.php'; require_once '../php/functions.php'; ?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Missões do Dia</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="navbar">
    <div class="nav-container">

        <div class="nav-logo">
            <img src="../imgs/logo.png" alt="Logo">
            <span>Missões do Dia</span>
        </div>

        <nav class="nav-links">
            <a href="index.php">Início</a>
            <a href="mural.php">Mural</a>
            <a href="sobre.php">Sobre</a>   
        </nav>

        <div class="nav-actions">
            <a class="login" href="login.php">Entrar</a>
            <a class="register" href="register.php">Criar conta</a>
        </div>

    </div>
</header>


  <main class="landing">

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-text">
            <h1>Transforme seu dia com pequenas ações positivas</h1>
            <p>
                O <strong>Missões do Dia</strong> ajuda você a praticar gentileza, evoluir como pessoa e
                inspirar outras pessoas através do mural comunitário.  
            </p>
            <a href="register.php" class="btn-hero">Criar conta gratuitamente</a>
        </div>

        <div class="hero-img">
            <img src="../imgs/inicio.png" alt="Missões ilustradas">
        </div>
    </section>

    <!-- FEATURES -->
    <section class="features">
        <h2>Como funciona</h2>

        <div class="features-grid">

            <div class="feature-card">
                <h3>✨ Gere missões positivas</h3>
                <p>A cada dia você recebe uma pequena missão inspiradora para melhorar seu dia e o de alguém.</p>
            </div>

            <div class="feature-card">
                <h3>💬 Compartilhe com a comunidade</h3>
                <p>Publique sua missão no mural público e inspire outras pessoas a fazerem o mesmo.</p>
            </div>

            <div class="feature-card">
                <h3>👍 Reaja às missões</h3>
                <p>Curta ou dê dislike para mostrar o impacto que cada ação causa.</p>
            </div>

            <div class="feature-card">
                <h3>👤 Acompanhe seu progresso</h3>
                <p>Veja seu histórico completo e acompanhe sua evolução diária.</p>
            </div>

        </div>
    </section>

    <section class="cta">
        <h2>Pronto para começar?</h2>
        <p>Leva menos de 1 minuto para criar seu perfil.</p>
        <a href="register.php" class="btn-cta">Criar minha conta agora</a>
    </section>

</main>

  <footer class="footer">
    <div class="container">Feito por Léo • Missões do Dia</div>
  </footer>
</body>
</html>