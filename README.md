<div align="center">

<img src="../Encanto-Pet/public/assets/img/logo.svg" width="120" alt="Encanto Pet Logo" />

# 🐾 Encanto Pet

**Uma loja virtual completa para produtos pet, construída com Laravel 12.**
**A complete online pet shop, built with Laravel 12.**

[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)](https://www.php.net)
[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-3-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)
[![Deploy](https://img.shields.io/badge/Deploy-Railway-0B0D0E?style=flat-square&logo=railway&logoColor=white)](https://web-production-227c7.up.railway.app)

🌐 **[Acesse a aplicação / Live Demo](https://web-production-227c7.up.railway.app)**

[🇧🇷 Português](#-português) · [🇺🇸 English](#-english)

</div>

---

## 🇧🇷 Português

### 📖 Sobre o Projeto

O **Encanto Pet** é uma aplicação web de e-commerce voltada para produtos de pet shop. O sistema permite que os clientes naveguem por um catálogo de produtos, realizem compras com pagamento integrado via **Mercado Pago** e recebam notificações por e-mail por meio do **Resend**.

### ✨ Funcionalidades

- 🛍️ Catálogo de produtos com navegação e filtros
- 🔐 Autenticação de usuários (login, registro e recuperação de senha)
- 🛒 Carrinho de compras
- 💳 Pagamento integrado com **Mercado Pago**
- 📧 Envio de e-mails transacionais com **Resend**
- 📱 Interface responsiva com **Tailwind CSS**

### 🛠️ Tecnologias

| Camada | Tecnologia |
|---|---|
| Backend | PHP 8.2+, Laravel 12 |
| Frontend | Blade, Tailwind CSS, Vite |
| Autenticação | Laravel Breeze |
| Pagamentos | Mercado Pago SDK |
| E-mail | Resend |
| Testes | Pest PHP |

### ⚙️ Pré-requisitos

Certifique-se de ter instalado:

- [PHP](https://www.php.net/) 8.2 ou superior
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) e npm
- Banco de dados (SQLite, MySQL ou PostgreSQL)

### 🚀 Instalação e Configuração

**1. Clone o repositório**
```bash
git clone https://github.com/Encanto-Pet/Encanto-Pet.git
cd Encanto-Pet
```

**2. Configure o ambiente**
```bash
cp .env.example .env
```

**3. Preencha as variáveis necessárias no `.env`:**
```env
APP_NAME="Encanto Pet"
APP_URL=http://localhost

DB_CONNECTION=sqlite
# ou configure MySQL/PostgreSQL

MERCADOPAGO_ACCESS_TOKEN=seu_token_aqui

RESEND_API_KEY=sua_chave_aqui
MAIL_FROM_ADDRESS=seu@email.com
```

**4. Instale as dependências e configure o projeto**
```bash
composer run setup
```

> Esse comando instala as dependências PHP e Node, gera a chave da aplicação, e executa as migrations automaticamente.

**5. Inicie o servidor de desenvolvimento**
```bash
composer run dev
```

A aplicação estará disponível em `http://localhost:8000`.

### 🧪 Testes

```bash
composer run test
```

### 📁 Estrutura do Projeto

```
Encanto-Pet/
├── app/
│   ├── Http/          # Controllers, Middleware, Requests
│   ├── Models/        # Modelos Eloquent
│   └── ...
├── database/
│   ├── migrations/    # Migrações do banco de dados
│   └── seeders/       # Seeders
├── resources/
│   ├── views/         # Templates Blade
│   └── css/js/        # Assets frontend
├── routes/            # Definição de rotas
└── tests/             # Testes automatizados (Pest)
```

### 🤝 Contribuindo

Contribuições são muito bem-vindas! Para contribuir:

1. Faça um **fork** do repositório
2. Crie uma branch para sua feature: `git checkout -b feature/minha-feature`
3. Faça seus commits: `git commit -m 'feat: adiciona minha feature'`
4. Faça o push: `git push origin feature/minha-feature`
5. Abra um **Pull Request**

Por favor, certifique-se de que seus testes passam antes de abrir o PR.

### 👥 Equipe

<table>
  <tr>
    <td align="center">
      <a href="https://github.com/Encanto-Pet">
        <img src="https://avatars.githubusercontent.com/u/262590275?s=80&v=4" width="80" /><br/>
        <sub><b>Encanto Pet</b></sub>
      </a>
    </td>
  </tr>
</table>

> Quer aparecer aqui? Contribua com o projeto! 🐾

### 📄 Licença

Este projeto está licenciado sob a licença **MIT**. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

## 🇺🇸 English

### 📖 About the Project

**Encanto Pet** is a web e-commerce application focused on pet shop products. It allows customers to browse a product catalog, make purchases with integrated **Mercado Pago** payments, and receive email notifications powered by **Resend**.

### ✨ Features

- 🛍️ Product catalog with browsing and filters
- 🔐 User authentication (login, register, password reset)
- 🛒 Shopping cart
- 💳 Integrated payments via **Mercado Pago**
- 📧 Transactional email sending via **Resend**
- 📱 Responsive interface with **Tailwind CSS**

### 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.2+, Laravel 12 |
| Frontend | Blade, Tailwind CSS, Vite |
| Auth | Laravel Breeze |
| Payments | Mercado Pago SDK |
| Email | Resend |
| Testing | Pest PHP |

### ⚙️ Prerequisites

Make sure you have installed:

- [PHP](https://www.php.net/) 8.2 or higher
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) and npm
- A database (SQLite, MySQL, or PostgreSQL)

### 🚀 Installation & Setup

**1. Clone the repository**
```bash
git clone https://github.com/Encanto-Pet/Encanto-Pet.git
cd Encanto-Pet
```

**2. Set up the environment**
```bash
cp .env.example .env
```

**3. Fill in the required variables in `.env`:**
```env
APP_NAME="Encanto Pet"
APP_URL=http://localhost

DB_CONNECTION=sqlite
# or configure MySQL/PostgreSQL

MERCADOPAGO_ACCESS_TOKEN=your_token_here

RESEND_API_KEY=your_key_here
MAIL_FROM_ADDRESS=your@email.com
```

**4. Install dependencies and set up the project**
```bash
composer run setup
```

> This command installs PHP and Node dependencies, generates the application key, and runs migrations automatically.

**5. Start the development server**
```bash
composer run dev
```

The app will be available at `http://localhost:8000`.

### 🧪 Running Tests

```bash
composer run test
```

### 📁 Project Structure

```
Encanto-Pet/
├── app/
│   ├── Http/          # Controllers, Middleware, Requests
│   ├── Models/        # Eloquent Models
│   └── ...
├── database/
│   ├── migrations/    # Database migrations
│   └── seeders/       # Seeders
├── resources/
│   ├── views/         # Blade templates
│   └── css/js/        # Frontend assets
├── routes/            # Route definitions
└── tests/             # Automated tests (Pest)
```

### 🤝 Contributing

Contributions are very welcome! To contribute:

1. **Fork** the repository
2. Create a feature branch: `git checkout -b feature/my-feature`
3. Commit your changes: `git commit -m 'feat: add my feature'`
4. Push to the branch: `git push origin feature/my-feature`
5. Open a **Pull Request**

Please make sure your tests pass before opening a PR.

### 👥 Team

<table>
  <tr>
    <td align="center">
      <a href="https://github.com/Encanto-Pet">
        <img src="https://avatars.githubusercontent.com/u/262590275?s=80&v=4" width="80" /><br/>
        <sub><b>Encanto Pet</b></sub>
      </a>
    </td>
  </tr>
</table>

> Want to show up here? Contribute to the project! 🐾

### 📄 License

This project is licensed under the **MIT License**. See the [LICENSE](LICENSE) file for details.

---

<div align="center">
  Made with 🐾 and ❤️ by the Encanto Pet team
</div>