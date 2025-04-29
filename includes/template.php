<?php
    require_once 'includes/config.php';

    $isLoginPage    = basename($_SERVER['PHP_SELF']) === 'index.php';
    $isRegisterPage = basename($_SERVER['PHP_SELF']) === 'register.php';
    $isProfilePage  = basename($_SERVER['PHP_SELF']) === 'profile.php';

    if ($isProfilePage && ! isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }

    if ($isProfilePage) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro ao buscar dados do usuário");
        }
    }

    $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?php echo $isLoginPage ? 'Login' : ($isRegisterPage ? 'Criar Conta' : 'Perfil'); ?> - Alfama Web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #046c97;
            --header-bg:                                                                                                                                                                                                 <?php echo $isProfilePage ? '#046c97' : '#fff'; ?>;
            --header-text:                                                                                                                                                                                                                 <?php echo $isProfilePage ? '#fff' : '#046c97'; ?>;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .header-logo {
            height: 36px;
            width: auto;
        }

        header {
            padding: 1.5rem 0;
            background-color: var(--header-bg);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header-link {
            color: var(--header-text);
            font-weight: 600;
            text-decoration: none;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }


        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .avatar-container {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 0.875em;
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
    </style>
</head>
<body>
    <header class="container-fluid">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="<?php echo $baseUrl; ?>assets/img/Logo.png" alt="Logo Alfama" class="header-logo">
            <a href="https://alfamaweb.com.br/" target="_blank" class="header-link">Saiba mais</a>
        </div>
    </header>

    <main class="container py-5 mb-3">
        <?php if ($isLoginPage || $isRegisterPage): ?>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-0 shadow rounded overflow-hidden">
                        <div class="col-md-6 bg-white p-5">
                        </div>
                        <div class="col-md-6 d-none d-md-flex flex-column justify-content-center bg-light p-5">
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($isProfilePage): ?>
            <div class=" py-5">
                <div >
                    <div class=" p-4">
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
                        </div>

                        <form id="profileForm" novalidate>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="full_name" class="form-label">Nome Completo *</label>
                                        <input type="text" class="form-control" id="full_name"
                                               value="<?php echo htmlspecialchars($user['full_name']); ?>"
                                               required>
                                        <div class="invalid-feedback">Por favor, informe seu nome completo</div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="phone" class="form-label">Telefone</label>
                                        <input type="text" class="form-control" id="phone"
                                               value="<?php echo htmlspecialchars($user['phone']); ?>"
                                               placeholder="(00) 00000-0000">
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="company" class="form-label">Empresa</label>
                                        <input type="text" class="form-control" id="company"
                                               value="<?php echo htmlspecialchars($user['company']); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" class="form-control" id="email"
                                               value="<?php echo htmlspecialchars($user['email']); ?>"
                                               required>
                                        <div class="invalid-feedback">Por favor, informe um e-mail válido</div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" id="cpf"
                                               value="<?php echo htmlspecialchars($user['cpf']); ?>"
                                               placeholder="000.000.000-00">
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="address" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" id="address"
                                               value="<?php echo htmlspecialchars($user['address']); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="bi bi-check-circle me-2"></i>Atualizar Cadastro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastEl = document.getElementById('liveToast');
            const toastTitle = document.getElementById('toastTitle');
            const toastMessage = document.getElementById('toastMessage');
            let toast = null;

            if (toastEl && toastTitle && toastMessage) {
                toast = new bootstrap.Toast(toastEl);
            }

            function showToast(title, message, isSuccess = true) {
                if (!toast || !toastTitle || !toastMessage) {
                    alert(`${title}: ${message}`);
                    return;
                }

                toastTitle.textContent = title;
                toastMessage.textContent = message;

                const header = toastEl.querySelector('.toast-header');
                const body = toastEl.querySelector('.toast-body');

                header.className = 'toast-header ' + (isSuccess ? 'bg-success text-white' : 'bg-danger text-white');
                body.className = 'toast-body bg-white';

                toast.show();
            }

            const cameraIcon = document.getElementById('cameraIcon');
            const avatarUpload = document.getElementById('avatarUpload');
            const profileAvatar = document.getElementById('profileAvatar');

            if (cameraIcon && avatarUpload && profileAvatar) {
                cameraIcon.addEventListener('click', function() {
                    avatarUpload.click();
                });

                avatarUpload.addEventListener('change', function(e) {
                    if (e.target.files && e.target.files[0]) {
                        const file = e.target.files[0];

                        if (!file.type.match('image.*')) {
                            showToast('Erro', 'Por favor, selecione uma imagem válida', false);
                            return;
                        }

                        if (file.size > 2 * 1024 * 1024) {
                            showToast('Erro', 'A imagem deve ter no máximo 2MB', false);
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(event) {
                            profileAvatar.src = event.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            const profileForm = document.getElementById('profileForm');
            if (profileForm) {
                profileForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    profileForm.querySelectorAll('.is-invalid').forEach(el => {
                        el.classList.remove('is-invalid');
                    });

                    const getValue = (id) => {
                        const el = document.getElementById(id);
                        return el ? el.value.trim() : '';
                    };

                    const formData = {
                        full_name: getValue('full_name'),
                        email: getValue('email'),
                        phone: getValue('phone').replace(/\D/g, ''),
                        company: getValue('company'),
                        cpf: getValue('cpf').replace(/\D/g, ''),
                        address: getValue('address')
                    };

                    let isValid = true;

                    if (!formData.full_name || formData.full_name.split(' ').length < 2) {
                        document.getElementById('full_name').classList.add('is-invalid');
                        isValid = false;
                    }

                    if (!formData.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
                        document.getElementById('email').classList.add('is-invalid');
                        isValid = false;
                    }

                    if (!isValid) {
                        showToast('Erro', 'Corrija os campos destacados', false);
                        return;
                    }

                    fetch('process/update.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(async response => {
                        const data = await response.json();
                        if (!response.ok) {
                            throw new Error(data.message || 'Erro ao atualizar');
                        }
                        return data;
                    })
                    .then(data => {
                        showToast('Sucesso', 'Perfil atualizado com sucesso!');
                    })
                    .catch(error => {
                        showToast('Erro', error.message || 'Falha na atualização', false);
                    });
                });
            }
        });
    </script>
</body>
</html>