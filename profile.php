<?php
    require_once 'includes/config.php';

    if (! isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro ao buscar dados do usuário");
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Alfama Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h1 class="mb-0">ALFÁIMÁUS</h1>
                        <h2 class="h4 mb-0"><?php echo htmlspecialchars($user['full_name']); ?></h2>
                        <p class="mb-0">Corretora</p>
                    </div>
                    <div class="card-body">
                        <form id="profileForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="mb-4 fw-bold">Nome Completo</h3>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="full_name" name="full_name"
                                               value="<?php echo htmlspecialchars($user['full_name']); ?>" placeholder="Digite seu nome" required>
                                    </div>
                                    <h3 class="mb-4 fw-bold">Telefone</h3>
                                    <div class="mb-3">
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                               value="<?php echo htmlspecialchars($user['phone']); ?>" placeholder="Digite seu telefone">
                                    </div>
                                    <h3 class="mb-4 fw-bold">Empresa</h3>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="company" name="company"
                                               value="<?php echo htmlspecialchars($user['company']); ?>" placeholder="Digite sua empresa">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-4 fw-bold">Email</h3>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="Digite seu email" required>
                                    </div>
                                    <h3 class="mb-4 fw-bold">CPF</h3>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="cpf" name="cpf"
                                               value="<?php echo htmlspecialchars($user['cpf']); ?>" placeholder="Digite seu CPF">
                                    </div>
                                    <h3 class="mb-4 fw-bold">Endereço</h3>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="address" name="address"
                                               value="<?php echo htmlspecialchars($user['address']); ?>" placeholder="Digite seu endereço">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-4 fw-bold">Atualizar cadastro</button>
                                <a href="logout.php" class="btn btn-light btn-sm fw-bold">Sair</a>

                            </div>

                        </form>
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