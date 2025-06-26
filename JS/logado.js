            document.addEventListener("DOMContentLoaded", function () {
                fetch('/ConectaLocal/php/check_login.php')
                    .then(response => response.json())
                    .then(data => {
                        const loginLink = document.querySelector('.login-mobile a');
                        const nomeSpan = document.getElementById('nomeUsuario');
                        if (!loginLink) return;

                        if (data.loggedIn) {
                            loginLink.textContent = 'Sair';
                            loginLink.href = '/ConectaLocal/php/logout.php';

                            // Mostrar o nome (ex: "Olá, Daniel")
                            if (nomeSpan) {
                                nomeSpan.textContent = `Olá, ${data.nome}`;
                            }
                        } else {
                            loginLink.textContent = 'Entrar';
                            loginLink.href = '/ConectaLocal/HTML/form.html';

                            // Limpar nome caso não esteja logado
                            if (nomeSpan) {
                                nomeSpan.textContent = '';
                            }
                        }
                    })
                    .catch(err => console.error('Erro ao verificar login:', err));
            });
