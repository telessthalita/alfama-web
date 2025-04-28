<?php
// Verifica se é página de login ou registro
$isLoginPage = basename($_SERVER['PHP_SELF']) === 'index.php';
$isRegisterPage = basename($_SERVER['PHP_SELF']) === 'register.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isLoginPage ? 'Login' : ($isRegisterPage ? 'Criar Conta' : 'Perfil'); ?> - Alfama Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <?php if ($isLoginPage || $isRegisterPage): ?>
                            <h1 class="text-center mb-4"><?php echo $isLoginPage ? 'Fazer login' : 'Criar conta'; ?></h1>
                            
                            <?php if ($isRegisterPage): ?>
                                <button type="button" class="btn btn-outline-primary w-100 mb-4">
                                    <img src="https://img.icons8.com/color/16/000000/google-logo.png" alt="Google" class="me-2">
                                    Faça login com o Google
                                </button>
                                <hr class="my-4">
                            <?php endif; ?>
                            
                            <form id="<?php echo $isLoginPage ? 'loginForm' : 'registerForm'; ?>">
                                <?php if ($isRegisterPage): ?>
                                    <div class="mb-3">
                                        <label for="full_name" class="form-label fw-bold">Nome completo</label>
                                        <input type="text" class="form-control" id="full_name" placeholder="Digite seu nome completo" required>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="<?php echo $isLoginPage ? 'Digite seu email' : 'Digite seu email'; ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold"><?php echo $isLoginPage ? 'Senha' : 'Senha'; ?></label>
                                    <input type="password" class="form-control" id="password" placeholder="<?php echo $isLoginPage ? 'Digite sua senha' : 'Crie uma senha'; ?>" required <?php echo $isRegisterPage ? 'minlength="8"' : ''; ?>>
                                    <?php if ($isRegisterPage): ?>
                                        <small class="text-muted">Inserir mais de 8 caracteres</small>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if ($isLoginPage): ?>
                                    <div class="mb-3 text-end">
                                        <a href="#" class="text-decoration-none">Esqueceu sua senha?</a>
                                    </div>
                                <?php endif; ?>
                                
                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                    <?php echo $isLoginPage ? 'Entrar' : 'Criar conta'; ?>
                                </button>
                                
                                <?php if ($isLoginPage): ?>
                                    <button type="button" class="btn btn-outline-primary w-100">
                                        <img src="https://img.icons8.com/color/16/000000/google-logo.png" alt="Google" class="me-2">
                                        Entrar com a conta Google
                                    </button>
                                <?php endif; ?>
                            </form>
                            
                            <div class="text-center mt-3">
                                <?php if ($isLoginPage): ?>
                                    <p>Nova conta? <a href="register.php">Cadastre-se gratuitamente</a></p>
                                <?php else: ?>
                                    <p>Já tem uma conta? <a href="index.php">Faça login</a></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($isLoginPage): ?>
                        <div class="card-footer text-center">
                            <small>Política de Privacidade</small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="col-md-6 d-none d-md-block">
                <div class="p-5">
                    <h2 class="fw-light">Lorem ipsum dolor sit conse ctetur adipis.</h2>
                    <p class="fw-light">Lorem ipsum dolor sit amet, consectetur adipis elit. Donec euismod risus vitae libero vestibulu.</p>
                    <div class="d-flex align-items-center">
                        <div class="me-2">⭐⭐⭐⭐⭐ 5.0</div>
                        <div>+200 comentários</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast para mensagens -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto" id="toastTitle">Mensagem</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastMessage"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>