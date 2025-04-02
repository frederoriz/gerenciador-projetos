# Gerenciador de Produtos - Laravel

## 📦 Pré-requisitos

Antes de começar, verifique se seu sistema atende aos seguintes requisitos:

- PHP 8.3
- Composer 2.5+
- SQLite3
- Node.js 18+ (para assets frontend)
- Git

## 🚀 Instalação

Siga estes passos para configurar o projeto localmente:

### 1. Clonar o repositório
```bash
git clone https://github.com/frederoriz/gerenciamento-produtos.git
cd gerenciamento-produtos
```

### 2. Instalar dependências PHP
```bash
composer install
```

### 3. Configurar ambiente
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Migrar banco de dados
```bash
php artisan migrate
```

### 5. Instalar dependências frontend
```bash
npm install
npm run build
```

## 🧪 Executando Testes

Para executar a suíte de testes:

```bash
php artisan test
```

Para testes com cobertura (requer Xdebug ou PCOV):
```bash
php artisan test --coverage-html coverage
```

## 🌟 Servidor de Desenvolvimento

Inicie o servidor local:

```bash
php artisan serve
```

Acesse: [http://localhost:8000](http://localhost:8000)
