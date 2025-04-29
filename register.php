<?php
    require_once './includes/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Criar conta - Alfama Web</title>
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
      margin-top: 4rem;
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
    #loading {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 9999;
      justify-content: center;
      align-items: center;
    }
    .spinner {
      width: 50px;
      height: 50px;
      border: 5px solid #f3f3f3;
      border-top: 5px solid #046c97;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>

<div id="loading">
  <div class="spinner"></div>
</div>

<div class="login-container">
  <div class="form-section">
    <div class="container d-flex justify-content-between align-items-center">
      <img src="./assets/img/Azul.png" alt="Logo Alfama" class="logo" />
      <a href="https://alfamaweb.com.br/" target="_blank">Saiba mais</a>
    </div>
    <h2>Criar conta</h2>
    <div class="d-grid mb-3">
    <button class="btn btn-outline-dark d-flex justify-content-center align-items-center w-auto" type="button" style="max-width: 400px;">
      <i class="bi bi-google "></i> Fazer login com o Google
    </button>
    </div>

    <form id="registerForm" action="register.php" method="POST" style="max-width: 400px;">
      <div class="mb-3">
        <label for="name" class="form-label">Nome Completo</label>
        <input type="text" id="name" class="form-control" placeholder="Digite seu nome completo" required />
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" class="form-control" placeholder="Digite seu email" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" id="password" class="form-control" placeholder="Crie uma senha" required />
        <small id="passwordHelp" class="form-text text-muted">Insira mais de 8 caracteres.</small>
      </div>
      <div class="d-grid mb-3">
        <button class="btn btn-primary" type="submit" style="background-color: #046c97;">Criar conta</button>
      </div>
      <p class="fw-semibold d-flex justify-content-center">Já tem uma conta? <a href="index.php">Faça login</a></p>
    </form>
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
<script src="assets/js/script.js" type="module"></script>
</body>
</html>
