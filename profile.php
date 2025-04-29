<?php
    session_start();

    if (! isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }

    if (! isset($_SESSION['user']) && isset($_SESSION['user_id'])) {
        require_once './includes/config.php';

        $stmt = $pdo->prepare("SELECT id, name, email, phone, company, cpf, address FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $_SESSION['user'] = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    $user = $_SESSION['user'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #046c97;
            --header-bg: #046c97;
            --header-text: #fff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        .header-logo {
            height: 30px;
            width: auto;
        }

        header {
            padding: 1.5rem 0;
            background-color: var(--header-bg);
        }

        .header-link {
            color: var(--header-text);
            font-weight: 600;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
        }

        .profile-container {
            max-width: 800px;
            margin: 1rem auto;
            padding: 1rem;
        }

        .profile-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }

        .profile-subtitle {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            border-radius: 6px;
            padding: 10px 12px;
            border: 1px solid #ddd;
            margin-bottom: 1rem;
            width: 100%;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 10px 24px;
            border-radius: 6px;
            font-weight: 600;
        }

        .divider {
            border-top: 1px solid #eee;
            margin: 1.5rem 0;
        }

        .avatar-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .camera-icon {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: var(--primary-color);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header class="container-fluid">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="./assets/img/Logo.png" alt="Logo Alfama" class="header-logo">
            <a href="https://alfamaweb.com.br/" target="_blank" class="header-link">Saiba mais</a>
        </div>
    </header>

    <main class="container">
        <div class="profile-container">
            <div class="avatar-container">
                <?php
                    $avatarSeed = md5($user['email']);
                    $avatarUrl  = "https://www.gravatar.com/avatar/{$avatarSeed}?d=identicon&s=120";
                ?>
                <img src="<?php echo $avatarUrl; ?>" class="profile-avatar" alt="Foto do perfil">
                <div class="camera-icon">
                    <i class="bi bi-camera"></i>
                </div>
            </div>

            <div class="text-center">
                <h2 class="profile-title"><?php echo htmlspecialchars($user['name']); ?></h2>
                <h3 class="profile-subtitle">Corretor(a)</h3>
            </div>

            <form id="profileForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="name"
                                   value="<?php echo htmlspecialchars($user['name']); ?>"
                                   placeholder="Digite seu nome">
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="phone"
                                   value="<?php echo htmlspecialchars($user['phone']); ?>"
                                   placeholder="Digite seu telefone">
                        </div>

                        <div class="form-group">
                            <label for="company" class="form-label">Empresa</label>
                            <input type="text" class="form-control" id="company"
                                   value="<?php echo htmlspecialchars($user['company']); ?>"
                                   placeholder="Digite sua empresa">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email"
                                   value="<?php echo htmlspecialchars($user['email']); ?>"
                                   placeholder="Digite seu email">
                        </div>

                        <div class="form-group">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf"
                                   value="<?php echo htmlspecialchars($user['cpf']); ?>"
                                   placeholder="Digite seu CPF">
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="address"
                                   value="<?php echo htmlspecialchars($user['address']); ?>"
                                   placeholder="Digite seu endereço">
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        Atualizar cadastro
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js" type="module"></script>
</body>
</html>
