# Gerenciamento de Domínios - Laravel

## 📌 Sobre o Projeto
Este projeto é uma aplicação web desenvolvida em Laravel para gerenciamento de domínios. 
Ele utiliza:

- **Laravel Sail** para ambiente Docker, 
- **Breeze** para autenticação: [link](https://github.com/laravel/breeze)
- **Log Viewer** para monitoramento de log files: [link](https://log-viewer.opcodes.io/)
- **Pulse** para monitoramento de performance: [link](https://pulse.laravel.com/)
- **Factories** e **Seeders** para popular o banco de dados.

---

## ✅ **1. Pré-requisitos**
Você precisa ter instalado:

- **Docker e Docker Compose** → [Instalar Docker](https://docs.docker.com/get-docker/)
- **Git** → [Instalar Git](https://git-scm.com/downloads)
- **Node.js e NPM** → [Instalar Node.js](https://nodejs.org/)
- **Composer** → [Instalar Composer](https://getcomposer.org/download/)

---

## 🛠️ **2. Instalação e Configuração**

### 🔻 **Clonar o repositório**
```
 git clone https://github.com/eduAssis/gerenciamento-dominio-laravel.git
```

### 🔻 **Instalar as dependências**
```
 composer install
 npm install
```

### 🔻 **Subir os containers com Laravel Sail**
```
 ./vendor/bin/sail up -d
```

### 🔻 **Executar as migrations e seeders**
```
 ./vendor/bin/sail artisan migrate --seed
```

### 🔻 **Executar o servidor de desenvolvimento do frontend:**
```
 npm run dev
```

---

## 🚀 **3. Rodando a Aplicação**

Acesse no navegador:
```
 http://localhost
```
Se estiver rodando Laravel Pulse, acesse:
```
 http://localhost/pulse
```

Se precisar rodar um comando dentro do container:
```
 ./vendor/bin/sail artisan migrate
```

Para acessar o terminal do container:
```
 ./vendor/bin/sail shell
```

---

## 🔥 **4. Autenticação com Laravel Breeze**

Breeze já está instalado e configurado:
```
 http://localhost/login
```
Credenciais de login (teste):
```
 email: test@test.com
 senha: 1234
```

---

## 🏗️ **5. Seeds e Factories**

O banco de dados pode ser populado com dados fictícios:
```
 ./vendor/bin/sail artisan db:seed
```
Se quiser recriar todo o banco:
```
 ./vendor/bin/sail artisan migrate:fresh --seed
```

---

## 📊 **6. Monitoramento com Laravel Pulse**
Laravel Pulse permite monitorar a performance da aplicação. Acesse:
```
 http://localhost/pulse
```
Se precisar reiniciar o Pulse:
```
 ./vendor/bin/sail artisan pulse:restart
```

---
## **Desenvolvido por Eduardo de Assis** 

- 🚀 **[GitHub](https://github.com/eduAssis)**
- 💼 **[LinkedIn](https://www.linkedin.com/in/eduardo-de-assis-21b308153)**

---