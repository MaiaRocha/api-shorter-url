# 🔗 Laravel 10 - URL Shortener API

Uma API simples construída com **Laravel 10** e **Docker**, que permite encurtar URLs. Utiliza **MySQL 8** como banco de dados.

---

## 🚀 Tecnologias

- PHP 8.2
- Laravel 10
- MySQL 8
- Docker & Docker Compose
- Composer

---

## ⚙️ Pré-requisitos

Antes de iniciar, você precisa ter os seguintes softwares instalados:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [Composer](https://getcomposer.org/)

---

## 🧪 Instalação do Projeto

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

### 2. Copie o arquivo `.env`

```bash
cp .env.example .env
```

### 3. Instale as dependências com o Composer

```bash
composer install
```

### 4. Suba o DB com o docker

```bash
docker-compose up -d
```

### 5. Execute as migrations

```bash
php artisan migrate
```

### 6. Execute os testes

```bash
php artisan test
```

### 7. Execute o projeto

```bash
php artisan serve
```

### 8. Acesse a documentação

[DOCUMENTAÇÃO](http://127.0.0.1:8000/docs/api)