document.addEventListener('DOMContentLoaded', function () {

    const toastEl = document.getElementById('liveToast');
    const toastTitle = document.getElementById('toastTitle');
    const toastMessage = document.getElementById('toastMessage');
    const toast = new bootstrap.Toast(toastEl);

    function showToast(title, message, isSuccess = true) {
        toastTitle.textContent = title;
        toastMessage.textContent = message;
        toastEl.classList.remove('bg-success', 'bg-danger');
        toastEl.classList.add(isSuccess ? 'bg-success' : 'bg-danger');
        toast.show();
    }
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch('process/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            })
                .then(async response => {
                    const text = await response.text();
                    try {
                        const data = JSON.parse(text);
                        if (!response.ok) {
                            // Mensagens específicas para diferentes códigos de status
                            if (response.status === 401) {
                                throw new Error(data.message || 'Credenciais inválidas');
                            } else {
                                throw new Error(data.message || 'Erro ao fazer login');
                            }
                        }
                        return data;
                    } catch (e) {
                        throw new Error(text || 'Resposta inválida do servidor');
                    }
                })
                .then(data => {
                    if (data.success) {
                        showToast('Sucesso', 'Login realizado com sucesso!');
                        setTimeout(() => {
                            window.location.href = 'profile.php';
                        }, 1500);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Erro', error.message, false);
                });
        });
    }

    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const full_name = document.getElementById('full_name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (password.length < 8) {
                showToast('Aviso', 'A senha deve ter pelo menos 8 caracteres', false);
                return;
            }

            fetch('process/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    full_name: full_name,
                    email: email,
                    password: password
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Sucesso', 'Cadastro realizado com sucesso! Faça login para continuar.');
                        setTimeout(() => {
                            window.location.href = 'index.php';
                        }, 2000);
                    } else {
                        showToast('Erro', data.message, false);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Erro', 'Erro ao processar cadastro', false);
                });
        });
    }

    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = {
                full_name: document.getElementById('full_name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                company: document.getElementById('company').value,
                cpf: document.getElementById('cpf').value,
                address: document.getElementById('address').value
            };

            fetch('process/update.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Sucesso', 'Dados atualizados com sucesso!');
                    } else {
                        showToast('Erro', data.message, false);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Erro', 'Erro ao atualizar dados', false);
                });
        });
    }
});