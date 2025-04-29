<?php
    require_once './includes/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - Alfama Web</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-weight: bold;
    }
    .login-container {
      display: flex;
      height: 100vh;
    }
    .form-section {
      flex: 1;
      padding: 60px 80px;
      background-color: #fff;
    }
    .form-section .logo {
      width: 180px;
      margin-bottom: 20px;
    }
    .form-section h2 {
      font-weight: bold;
      margin-bottom: 20px;
      margin-top: 8rem;
      width: 180px;
    }
    .image-section {
      flex: 1;
      background-image: url('./assets/img/img1.png');
      background-size: cover;
      background-position: center;
      position: relative;
      color: #fff;
      display: flex;
      align-items: center;
      padding: 80px;
    }
    .image-overlay {
      padding: 20px;
      display: flex;
      flex-direction: column;
      margin-top: auto;
    }
    .image-overlay h3 {
      font-size: 3rem;
      font-weight: bold;
    }
    .image-overlay p {
        margin-bottom: 1rem;
    }
    .rating {
      font-size: 1rem;
      font-weight: bold;
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .comments {
      font-size: 1rem;
      opacity: 0.8;
    }
    .arrows {
      position: absolute;
      bottom: 20px;
      right: 30px;
      display: flex;
      gap: 10px;
      font-size: 1.5rem;
    }
    .arrows i {
      cursor: pointer;
      color: white;
      transition: transform 0.2s ease;
    }
    .arrows i:hover {
      transform: scale(1.2);
    }
    .privacy {
      position: absolute;
      bottom: 20px;
      left: 60px;
      font-weight: bold;
    }
    a {
      text-decoration: none;
      color: #046c97;

    }
  </style>
</head>
<body>

<div class="login-container">
  <div class="form-section">
    <div class="container d-flex justify-content-between align-items-center">
      <img src="./assets/img/Azul.png" alt="Logo Alfama" class="logo" />
      <a href="https://alfamaweb.com.br/" target="_blank">Saiba mais</a>
    </div>
    <h2>Fazer login</h2>
    <p>Nova conta? <a href="register.php" class="fw-semibold">Cadastre-se gratuitamente</a></p>

    <form id="loginForm" style="max-width: 400px;">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" class="form-control" placeholder="Digite seu email" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" id="password" class="form-control" placeholder="Insira sua senha" required />
        <div class="mt-2">
          <a href="#" class="text-primary">Esqueceu sua senha?</a>
        </div>
      </div>
      <div class="d-grid mb-3">
      <button class="btn btn-primary" type="submit" style="background-color: #046c97;">Entrar</button>
      </div>
    </form>

    <div class="d-grid mb-3">
      <button class="btn btn-outline-dark d-flex justify-content-center align-items-center w-auto" type="button" style="max-width: 400px;">
        <i class="fab fa-google"></i> Fazer login com o Google
      </button>
    </div>

    <div class="privacy">
      <a href="#" class="text-dark">Política de Privacidade</a>
    </div>
  </div>

  <div class="image-section">
    <div class="image-overlay">
      <h3>Lorem ipsum dolor sit<br>conse ctetur adipis.</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipis</p>
      <p>elit. Donec euismod risus vitae libero vestibulu.</p>
      <div class="rating">
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        5.0
      </div>
      <div class="comments">+200 comentários</div>
    </div>
    <div class="arrows">
      <i class="bi bi-chevron-left"></i>
      <i class="bi bi-chevron-right"></i>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="assets/js/script.js" type="module"></script>
</body>
</html>
