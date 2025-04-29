<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Perfil - Alfama Web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #046c97;
            --secondary-color: #f8f9fa;
            --accent-color: #ff6b35;
            --text-color: #333;
            --light-text: #6c757d;
            --header-bg: #046c97;
            --header-text: #fff;
            --card-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: var(--text-color);
        }

        .header-logo {
            height: 36px;
            width: auto;
            transition: var(--transition);
        }

        .header-logo:hover {
            transform: scale(1.05);
        }

        header {
            padding: 1.5rem 0;
            background-color: var(--header-bg);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header-link {
            color: var(--header-text);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            padding: 0.5rem 1rem;
            border-radius: 4px;
        }

        .header-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .profile-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .profile-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: var(--transition);
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .profile-img:hover {
            transform: scale(1.05);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-color: #035a7f;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(4, 108, 151, 0.3);
        }

        .camera-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background-color: var(--primary-color);
            border-radius: 50%;
            position: absolute;
            bottom: 10px;
            right: 10px;
            color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            transition: var(--transition);
        }

        .camera-icon:hover {
            background-color: #035a7f;
            transform: scale(1.1);
        }

        .avatar-container {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(4, 108, 151, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #035a7f 100%);
            padding: 2rem;
            color: white;
            text-align: center;
            margin-bottom: 2rem;
            border-radius: 12px 12px 0 0;
        }

        .profile-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-top: 1rem;
        }

        .profile-email {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        .profile-content {
            padding: 2rem;
        }

        .info-badge {
            background-color: #e9f5fc;
            color: var(--primary-color);
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .info-badge i {
            margin-right: 6px;
        }

        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 5px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .is-invalid ~ .invalid-feedback {
            display: block;
        }

        .avatar-wrapper {
            text-align: center;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .profile-img {
                width: 120px;
                height: 120px;
            }

            .profile-name {
                font-size: 1.5rem;
            }

            .profile-content {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <header class="container-fluid">
        <div class="container d-flex justify-content-between align-items-center">
        <img src="./assets/img/Logo.png" alt="Logo Alfama" class="logo" />
            <a href="https://alfamaweb.com.br/" target="_blank" class="header-link">Saiba mais</a>
        </div>
    </header>

    <main class="container py-5 mb-5">
        <div class="profile-container">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="avatar-wrapper">
                        <div class="avatar-container">
                            <?php
                                $avatarSeed = $_SESSION['user_id'] ?? rand(1, 1000);
                                $avatarUrl  = "https://api.dicebear.com/7.x/identicon/svg?seed={$avatarSeed}&radius=50";
                            ?>
                            <img src="<?php echo $avatarUrl; ?>"
                                 class="profile-img"
                                 alt="Foto do perfil"
                                 id="profileAvatar">
                            <div class="camera-icon" id="cameraIcon">
                                <i class="bi bi-camera"></i>
                                <input type="file" id="avatarUpload" accept="image/*" class="d-none">
                            </div>
                        </div>
                        <h1 class="profile-name"><?php echo htmlspecialchars($user['full_name']); ?></h1>
                        <div class="profile-email"><?php echo htmlspecialchars($user['email']); ?></div>
                    </div>
                </div>

                <div class="profile-content">
                    <div class="info-badge">
                        <i class="bi bi-info-circle"></i> Preencha seus dados para melhor atendimento
                    </div>

                    <form id="profileForm" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <h3 class="section-title">Informações Pessoais</h3>

                                <div class="form-group mb-4">
                                    <label for="full_name" class="form-label">Nome Completo *</label>
                                    <input type="text" class="form-control" id="full_name"
                                           value="<?php echo htmlspecialchars($user['full_name']); ?>"
                                           required>
                                    <div class="invalid-feedback">Por favor, informe seu nome completo</div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="phone" class="form-label">Telefone</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="text" class="form-control" id="phone"
                                               value="<?php echo htmlspecialchars($user['phone']); ?>"
                                               placeholder="(00) 00000-0000">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                        <input type="text" class="form-control" id="cpf"
                                               value="<?php echo htmlspecialchars($user['cpf']); ?>"
                                               placeholder="000.000.000-00">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h3 class="section-title">Informações Profissionais</h3>

                                <div class="form-group mb-4">
                                    <label for="email" class="form-label">Email *</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" id="email"
                                               value="<?php echo htmlspecialchars($user['email']); ?>"
                                               required>
                                    </div>
                                    <div class="invalid-feedback">Por favor, informe um e-mail válido</div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="company" class="form-label">Empresa</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-building"></i></span>
                                        <input type="text" class="form-control" id="company"
                                               value="<?php echo htmlspecialchars($user['company']); ?>">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="address" class="form-label">Endereço</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                        <input type="text" class="form-control" id="address"
                                               value="<?php echo htmlspecialchars($user['address']); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="bi bi-check-circle me-2"></i>Atualizar Cadastro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-primary text-white">
                <strong class="me-auto" id="toastTitle">Mensagem</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body bg-white" id="toastMessage"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js" type="module"></script>
</body>
</html>