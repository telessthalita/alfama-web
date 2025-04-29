
# 🍦 Alfama Web - Sistema de Autenticação

## 📝 Descrição

Sistema web completo desenvolvido com:

-   PHP 8.2+
    
-   MySQL
    
-   Bootstrap 5
    
-   JavaScript 
    

Funcionalidades principais:

-   ✅ Cadastro de usuários
    
-   🔐 Autenticação segura
    
-   ✏️ Edição de perfil
    
-   📲 Design responsivo
    

## 🛠️ Pré-requisitos

Componente

Versão

PHP

8.2.12+

XAMPP


MySQL

Git


## 🚀 Instalação Passo a Passo

### 1. Configuração do Ambiente
cd C:\xampp\htdocs
git clone https://github.com/telessthalita/alfama-web.git

### 2. Iniciar Serviços no XAMPP

1.  Abra o XAMPP Control Panel
    
2.  Inicie os serviços:
    
    -   Apache
        
    -   MySQL
        

### 3. Configurar Banco de Dados

1.  Acesse phpMyAdmin:  [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
    
2.  Crie um novo banco:
        
    CREATE DATABASE alfama_web;
    
3.  Importe a estrutura:
    
    -   Arquivo:  `alfama-web/database.sql`
        
### 4. Acessar a Aplicação
http://localhost/alfama-web

## 🧪 Testes Recomendados

### 🔵 Fluxo de Cadastro

1.  Acesse  `/register.php`
    
2.  Preencha:
    
    -   Nome completo
        
    -   E-mail válido
        
    -   Senha (mais de 8 caracteres.)           

### 🟢 Fluxo de Login

1.  Use as credenciais cadastradas
    
2.  Verifique:
    
    -   Redirecionamento para  `/profile.php`
        
    -   Sessão persistente
        

### 🟡 Edição de Perfil

1.  Acesse  `/profile.php`
    
2.  Teste:
    
    -   Formatação automática de CPF/Telefone
        
    -   Validação de campos
        
    -   Persistência no banco