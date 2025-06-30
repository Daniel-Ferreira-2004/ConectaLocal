
# ConectaLocal

ConectaLocal é uma plataforma comunitária desenvolvida para facilitar a conexão entre pessoas que desejam oferecer ou solicitar ajuda por meio de serviços voluntários. O foco é criar uma rede de apoio solidário, especialmente voltada para idosos e pessoas com dificuldades de locomoção ou acesso digital.

## 👨‍💻 Participantes

- Daniel Ferreira (Desenvolvimento Full Stack)
- Gabriel Canashiro (Desenvolvimento Front)
- Vinnicius (Desenvolvimento Front)
- Welton (Desenvolvimento Front)
- Henrrique (Desenvolvimento Front)

## 🎯 Objetivo do Projeto

O objetivo principal é incentivar a solidariedade local, conectando voluntários a pessoas que precisam de assistência em atividades cotidianas, como:

- Aulas particulares
- Doações de alimentos
- Apoio psicológico
- Tarefas domésticas
- Transporte para idosos
- Apoio digital
- Entre outros serviços

## 🧰 Tecnologias Utilizadas

### 🔙 Backend

- **PHP:** Utilizado para processar os dados do formulário, autenticação, cadastro e envio de e-mails.
- **MySQL:** Banco de dados relacional utilizado para armazenar informações dos usuários, serviços e voluntários.
- **PHPMailer:** Biblioteca PHP para envio de e-mails por SMTP.

### 🌐 Frontend

- **HTML5 & CSS3:** Estruturação semântica e estilização responsiva do site.
- **JavaScript:** Dinamização da interface com foco em:
  - Manipulação do DOM
  - Validação de formulários
  - Controle de sessão (verificação de login)
- **SwiperJS:** Biblioteca para criação do carrossel responsivo de serviços voluntários.

### 📱 Responsividade

A interface do site foi desenvolvida com o conceito **Mobile First**, garantindo uma boa experiência em smartphones, tablets e desktops. O layout se adapta automaticamente ao tamanho da tela, incluindo o comportamento do carrossel.

## 🗃️ Estrutura do Banco de Dados

- **Tabela `formulariodaniel`:** Armazena os dados dos usuários (nome, email, senha, telefone, endereço).
- **Tabela `servicos`:** Contém os tipos de serviços disponíveis (ex: Apoio digital, Doação de alimentos, etc).
- **Tabela `voluntarios_servicos`:** Relaciona os usuários aos serviços em que são voluntários.

## 📁 Estrutura do Projeto

```
ConectaLocal/
├── HTML/
│   └── form.html              # Página de cadastro/login
    └── index.html             # Página inicial do site
├── CSS/
│   └── style.css              # Estilos principais
├── JS/
│   └── script.js              # Scripts de interação e carrossel
├── img/
│   └── Carrosel/              # Imagens dos serviços
├── php/
│   ├── config.php             # Conexão com banco de dados
│   ├── cadastrar.php          # Cadastro de novos usuários
│   ├── login.php              # Login e sessão
│   ├── voluntariar.php        # Cadastrar voluntário para serviço
│   ├── pedirAjuda.php         # Envia email aos voluntários
│   └── verificarSessao.php    # Verifica se o usuário está logado
├── phpmailer/                 # Biblioteca PHPMailer
```

## 📦 Como Executar Localmente

1. Baixe este repositório:

2. Instale o banco de dados MySQL e configure o arquivo `php/config.php` com seus dados locais.

3. Crie as tabelas no banco conforme o modelo utilizado (pode ser extraído das queries no código).

4. QR CODE:
  ![frame](https://github.com/user-attachments/assets/c6d8313e-072f-49f6-804b-137d79e16bcc)

   
4.Coloque a pasta do projeto junto ao HTDOCS do XAMPP. 

5. Execute localmente com um servidor (XAMPP, WAMP, ou outro que suporte PHP + MySQL).

6. Suposto caminho (localhost/HTML/index.html)

