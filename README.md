# Product Search with Laravel Livewire

Este repositório implementa um **mecanismo de busca de produtos com filtros combinados** utilizando **Laravel + Livewire**, executando em um **ambiente Docker**.

A solução foi desenvolvida sobre um projeto base existente, porém **todo o escopo do desafio foi isolado**, garantindo fácil avaliação e execução sem conflitos.

---

## ✅ Funcionalidades

- Busca de produtos por **nome**
- Filtro por **uma ou múltiplas categorias**
- Filtro por **uma ou múltiplas marcas**
- Combinação de filtros utilizando lógica **AND**
- Persistência dos filtros via **URL** (refresh mantém estado)
- Botão para **limpar filtros**
- **Testes automatizados** com Livewire

---

## 🛠️ Stack

- PHP 8.3
- Laravel
- Livewire v3
- MySQL 8
- Redis
- Docker / Docker Compose
- Tailwind (via CDN, sem build frontend)

---

## 🚀 Passo a passo para rodar o projeto

### 1️⃣ Clone o repositório

```bash
git clone https://github.com/natanbp7/teste_moot.git
cd teste_moot
```

---

### 2️⃣ Crie o arquivo `.env`

```bash
cp .env.example .env
```

Edite o `.env` com as seguintes configurações:

```dotenv
APP_NAME="Gestor de Estoque - Busca Avançada"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=username
DB_PASSWORD=userpass

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

---

### 3️⃣ Suba os containers Docker

```bash
docker-compose up -d --build
```

---

### 4️⃣ Acesse o container da aplicação

```bash
docker-compose exec app bash
```

---

### 5️⃣ Instale as dependências PHP

```bash
composer install
```

---

### 6️⃣ Gere a key do Laravel

```bash
php artisan key:generate
```

---

### 7️⃣ Rode migrations e seeders

```bash
php artisan migrate --seed
```

---

## 🔍 Acessando a funcionalidade do teste

A implementação do desafio está disponível em:

```
http://localhost:8000/products
```

Esta rota é **isolada do projeto base** e contém toda a lógica solicitada no teste técnico.

---

## 🧪 Executando os testes

O projeto base contém testes legados que não fazem parte do escopo do desafio.

Para rodar **apenas os testes relacionados ao Product Search**, execute:

```bash
php artisan test --filter=ProductSearchTest
```

Resultado esperado:

- Todos os testes do ProductSearch passam com sucesso

---

## 📁 Arquivos relevantes

- `app/Livewire/ProductSearch.php`
- `resources/views/livewire/product-search.blade.php`
- `resources/views/products/index.blade.php`
- `tests/Feature/Livewire/ProductSearchTest.php`
- `database/migrations`
- `database/seeders`

---

## 🧠 Observações finais

- O uso de Tailwind via CDN evita dependências de Node/Vite, mantendo o setup simples
- A solução prioriza **clareza, isolamento e testabilidade**, conforme solicitado

---

## ✅ Status

✔ Funcionalidade completa  
✔ Testes passando  
✔ Pronto para avaliação
