document.addEventListener('DOMContentLoaded', function () {
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

    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }

    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', handleRegister);
    }

    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        const phoneField = document.getElementById('phone');
        const cpfField = document.getElementById('cpf');

        if (phoneField) {
            phoneField.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 11) value = value.substring(0, 11);

                if (value.length > 0) {
                    value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
                    if (value.length > 10) {
                        value = value.replace(/(\d)(\d{4})$/, '$1-$2');
                    } else {
                        value = value.replace(/(\d)(\d{3})$/, '$1-$2');
                    }
                }

                e.target.value = value;
            });
        }

        if (cpfField) {
            cpfField.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 11) value = value.substring(0, 11);

                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

                e.target.value = value;
            });
        }

        profileForm.addEventListener('submit', function (e) {
            e.preventDefault();

            profileForm.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });

            const getValue = (id) => {
                const el = document.getElementById(id);
                return el ? el.value.trim() : '';
            };

            const formData = {
                name: getValue('name'),
                email: getValue('email'),
                phone: getValue('phone').replace(/\D/g, ''),
                company: getValue('company'),
                cpf: getValue('cpf').replace(/\D/g, ''),
                address: getValue('address')
            };

            let isValid = true;

            if (!formData.name || formData.name.split(' ').length < 2) {
                document.getElementById('name').classList.add('is-invalid');
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
                    if (data.user) {
                        document.getElementById('name').value = data.user.name;
                        document.getElementById('email').value = data.user.email;
                    }
                })
                .catch(error => {
                    showToast('Erro', error.message || 'Falha na atualização', false);
                });
        });
    }
    async function handleLogin(e) {
        e.preventDefault();
        const email = document.getElementById('email')?.value.trim() || '';
        const password = document.getElementById('password')?.value.trim() || '';

        if (!email || !password) {
            showToast('Erro', 'Por favor, preencha todos os campos', false);
            return;
        }

        try {
            const response = await fetch('process/login.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Credenciais inválidas');
            }

            showToast('Sucesso', 'Login realizado com sucesso!');
            setTimeout(() => window.location.href = 'profile.php', 1500);
        } catch (error) {
            showToast('Erro', error.message || 'Falha ao fazer login', false);
        }
    }

    async function handleRegister(e) {
        e.preventDefault();
        const name = document.getElementById('name')?.value.trim() || '';
        const email = document.getElementById('email')?.value.trim() || '';
        const password = document.getElementById('password')?.value.trim() || '';

        if (password.length < 8) {
            showToast('Aviso', 'A senha deve ter pelo menos 8 caracteres', false);
            return;
        }

        try {
            const response = await fetch('process/register.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name, email, password })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Erro no cadastro');
            }

            showToast('Sucesso', 'Cadastro realizado com sucesso!');
            setTimeout(() => window.location.href = 'index.php', 2000);
        } catch (error) {
            showToast('Erro', error.message || 'Erro ao processar cadastro', false);
        }
    }
});