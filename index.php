<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Alfama Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h1 class="text-center mb-4">Fazer login</h1>
                        <p class="text-center mb-4">Nova conta? <a href="register.php">Cadastre-se gratuitamente</a></p>
                        
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Digite seu email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" placeholder="Digite sua senha" required>
                            </div>
                            <div class="mb-3 text-end">
                                <a href="#" class="text-decoration-none">Esqueceu sua senha?</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Entrar</button>
                            <button type="button" class="btn btn-outline-primary w-100">
                                <img src="https://img.icons8.com/color/16/000000/google-logo.png" alt="Google" class="me-2">
                                Entrar com a conta Google
                            </button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <small>Política de Privacidade</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block">
                <div class="p-5">
                    <h2>Lorem ipsum dolor sit conse ctetur adipis.</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipis elit. Donec euismod risus vitae libero vestibulu.</p>
                    <div class="d-flex align-items-center">
                        <div class="me-2">⭐⭐⭐⭐⭐ 5.0</div>
                        <div>+200 comentários</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>