# 🛒  FlexSales - Sistema de Vendas com Pagamento Personalizado

## 📋 Descrição

O **FlexSales** é um sistema de vendas desenvolvido em **Laravel**, com painel administrativo baseado em **AdminLTE**. Ele permite o gerenciamento eficiente de **vendedores**, **clientes**, **produtos** e **vendas**, todos integrados com relacionamentos consistentes no banco de dados.

O destaque do sistema é a funcionalidade de **pagamento personalizado**, permitindo que o cliente defina livremente o valor de cada parcela durante a venda.

---

## 🚀 Tecnologias Utilizadas

- Laravel 11+
- PHP 8+
- MySQL
- AdminLTE
- Bootstrap
- Eloquent ORM

---

## ⚙️ Funcionalidades Principais

- Cadastro e gerenciamento de vendedores, clientes e produtos.
- Registro e controle completo das vendas.
- Sistema de pagamento flexível, com personalização dos valores de cada parcela.
- Relacionamentos estruturados para integridade dos dados.
- Painel administrativo responsivo e intuitivo utilizando AdminLTE.

---

## 📂 Instalação

1. Clone o repositório:

```bash
git clone https://github.com/seu-usuario/flexsales.git
cd flexsales
```

2. Instale as dependências do PHP e Node:

```bash
composer install
npm install
npm run dev
```

3. Configure o arquivo .env:

```bash 
cd .env.example .env
php artisan key:generate
```

4. Ajuste as informações do banco de dados no .env.

5. Execute as migrations:

```bash
php artisan migrate
```
6. Inicie o servidor local:

```bash
php artisan serve
```

## 🔑 Acesso
Credenciais de teste:

```makefile
Email: admin@teste.com
Senha: password
```

Inicie o DB Seeder:

```bash
php artisan db:seed
```

## 🛠️ Melhorias Futuras

Implementação de relatórios detalhados.
Dashboard com gráficos dinâmicos.
Integração com gateways de pagamento (Ex: PagSeguro, Stripe).
Otimização do CRUD com Livewire ou Inertia.js.

## 🤝 Licença
Projeto desenvolvido para fins de estudo e demonstração.

## 📎 Contato
**Para mais informações:**

Linkedin: https://www.linkedin.com/in/theodoro-henrique-20458827a/

Portfólio: https://theo-henrique.vercel.app/