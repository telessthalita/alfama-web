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

    function validateCPF(cpf) {
        cpf = cpf.replace(/\D/g, '');
        if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;

        let sum = 0;
        for (let i = 0; i < 9; i++) {
            sum += parseInt(cpf.charAt(i)) * (10 - i);
        }
        let remainder = (sum * 10) % 11;
        if (remainder === 10 || remainder === 11) remainder = 0;
        if (remainder !== parseInt(cpf.charAt(9))) return false;

        sum = 0;
        for (let i = 0; i < 10; i++) {
            sum += parseInt(cpf.charAt(i)) * (11 - i);
        }
        remainder = (sum * 10) % 11;
        if (remainder === 10 || remainder === 11) remainder = 0;
        if (remainder !== parseInt(cpf.charAt(10))) return false;

        return true;
    }

    // Manipuladores de formulário
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
        // Máscaras para campos
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
                e.target.classList.remove('is-invalid');
                document.getElementById('phone-feedback').textContent = '';
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
                e.target.classList.remove('is-invalid');
                document.getElementById('cpf-feedback').textContent = '';
            });

            cpfField.addEventListener('blur', function () {
                if (this.value && !validateCPF(this.value.replace(/\D/g, ''))) {
                    this.classList.add('is-invalid');
                    document.getElementById('cpf-feedback').textContent = 'CPF inválido';
                }
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
                document.getElementById('name-feedback').textContent = 'Nome completo é obrigatório';
                isValid = false;
            }

            if (!formData.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
                document.getElementById('email').classList.add('is-invalid');
                document.getElementById('email-feedback').textContent = 'Email inválido';
                isValid = false;
            }

            if (formData.cpf && !validateCPF(formData.cpf)) {
                document.getElementById('cpf').classList.add('is-invalid');
                document.getElementById('cpf-feedback').textContent = 'CPF inválido';
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
                        // Atualiza os campos com os novos dados
                        document.getElementById('name').value = data.user.name || '';
                        document.getElementById('email').value = data.user.email || '';
                        document.getElementById('phone').value = data.user.phone || '';
                        document.getElementById('company').value = data.user.company || '';
                        document.getElementById('cpf').value = data.user.cpf || '';
                        document.getElementById('address').value = data.user.address || '';
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
        const confirmPassword = document.getElementById('confirmPassword')?.value.trim() || '';

        // Validações
        if (!name || name.split(' ').length < 2) {
            showToast('Erro', 'Por favor, informe seu nome completo', false);
            return;
        }

        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showToast('Erro', 'Por favor, informe um email válido', false);
            return;
        }

        if (password.length < 8) {
            showToast('Aviso', 'A senha deve ter pelo menos 8 caracteres', false);
            return;
        }

        if (password !== confirmPassword) {
            showToast('Erro', 'As senhas não coincidem', false);
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