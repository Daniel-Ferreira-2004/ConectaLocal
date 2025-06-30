# 📌 ConectaLocal

## 1. Descrição do Projeto

O **ConectaLocal** é uma plataforma web voltada para conectar voluntários a pessoas que precisam de ajuda. O site permite que usuários se cadastrem, façam login, escolham serviços nos quais desejam se voluntariar e sejam notificados via e-mail quando alguém solicita ajuda nesses serviços.

## 2. Funcionalidades Principais

- Cadastro de usuários com nome, e-mail, senha, telefone e endereço.
- Login com verificação de senha (hash).
- Sessões PHP para manter o usuário autenticado.
- Escolha de serviços voluntários (Aulas Particulares, Doação de Alimentos, Compras para idosos etc).
- Envio de e-mails automáticos via PHPMailer:
  - Confirmação de cadastro como voluntário.
  - Notificação para voluntários quando alguém pede ajuda.
- Área protegida que exige autenticação para solicitar ajuda ou se voluntariar.

## 3. Tecnologias Utilizadas

| Camada              | Tecnologias/Frameworks                                    |
|---------------------|-----------------------------------------------------------|
| Backend             | PHP, MySQL                                                |
| Envio de E-mails    | PHPMailer                                                 |
| Frontend            | HTML5, CSS3, JavaScript, Swiper.js                        |
| Autenticação        | `password_hash()` / `password_verify()`, `session_start()`|
| Segurança SQL       | `mysqli` com `prepare` e `bind_param`                     |
| AJAX                | Fetch API para exibir nome de usuário logado             |

## 4. Banco de Dados

### Estrutura:

- **formulariodaniel** (tabela de usuários):
  - `id`, `nome`, `sobrenome`, `email`, `senha`, `telefone`, `endereco`

- **servicos**:
  - `id`, `nome_servico`

- **voluntarios_servicos**:
  - `id`, `id_usuario`, `id_servico`

## 5. Organização de Arquivos

```
/
├── HTML/
├── CSS/
├── JS/
├── PHP/
│   ├── config.php
│   ├── login.php
│   ├── logout.php
│   ├── voluntariar.php
│   ├── pedirAjuda.php
│   ├── check_login.php
├── phpmailer/
```

## 6. Fluxo de Uso

1. Cadastro via formulário (senha é hasheada).
2. Login ativa a sessão com ID do usuário.
3. Áreas restritas só acessíveis com sessão ativa.
4. Voluntariado grava no DB e envia e-mail de confirmação.
5. Pedidos de ajuda disparam e-mails aos voluntários daquele serviço.

## 7. Como Rodar Localmente

1. Clone o repositório:
```bash
git clone https://github.com/daniel-ferreira-2004/ConectaLocal.git
```
2. Copie para o diretório do XAMPP/WAMP.
3. Configure o `config.php` com o acesso ao MySQL.
4. Importe o banco de dados e insira os serviços.
5. Ajuste credenciais SMTP no PHPMailer.
6. Acesse via `http://localhost/ConectaLocal/HTML/form.html`.

## 8. Participantes

- **Daniel Ferreira** – Desenvolvedor full-stack

## 9. Futuras Melhorias

- Validação frontend aprimorada.
- Upload de foto de perfil.
- Dashboard de usuário.
- Estilo moderno com Bootstrap/Tailwind.
- API REST e autenticação JWT.

## 10. Licença

MIT License.
