<p align="center">
  <a href="#">
    <img src="public/imagem/logo.png" width="250" alt="Locação Logo">
  </a>
</p>


<p align="center">
  <a href="https://img.shields.io/badge/php-%5E8.2-8892BF"><img src="https://img.shields.io/badge/php-%5E8.2-8892BF" alt="PHP Version"></a>
  <a href="https://img.shields.io/badge/laravel-%5E12.0-FF2D20"><img src="https://img.shields.io/badge/laravel-%5E12.0-FF2D20" alt="Laravel Version"></a>
  <a href="https://img.shields.io/badge/node-%3E%3D18.x-339933"><img src="https://img.shields.io/badge/node-%3E%3D18.x-339933" alt="Node.js Version"></a>
  <a href="https://img.shields.io/badge/license-MIT-green"><img src="https://img.shields.io/badge/license-MIT-green" alt="License"></a>
</p>

# Locação

## Descrição geral

`Locação` é uma aplicação web para gerenciamento de locação de bungalow/Casas de temporada. Os usuários podem selecionar itens para locação, definir o período desejado e receber confirmação automática por e-mail. A aplicação integra:

- Envio de e-mails automatizados via **Brevo**  
- Proteção de formulários com **reCAPTCHA**  
- Processo de pagamento simulado via **Multibanco**

## Tecnologias utilizadas

### Backend

- **PHP**: ^8.2  
- **Laravel Framework**: ^12.0  
- **Laravel Tinker**: ^2.10.1  

### Frontend

- **Node.js**: >=18.x  
- **Vite**: ^6.0.11  
- **Laravel Vite Plugin**: ^1.2.0  
- **Alpine.js**: ^3.4.2  
- **Tailwind CSS**: ^3.1.0  
- **@tailwindcss/forms**: ^0.5.2  
- **@tailwindcss/vite**: ^4.0.0  
- **PostCSS**: ^8.4.31  
- **Autoprefixer**: ^10.4.2   
 

### APIs e Integrações

- **Brevo**: envio de e-mails transacionais  
- **Google reCAPTCHA**: autenticação de formulários  

### Pagamento

- **Multibanco (fictício)**: simulação de pagamento sem integração real

## Instalação e execução

### Pré-requisitos

- PHP ^8.2  
- Composer  
- Node.js >=18.x  
- NPM  
- Banco de dados (MySQL Workbench, MySQL, PostgreSQL.)  
- **Variáveis de ambiente**:  
  - `DB_*`: credenciais do banco  
  - `BREVO_API_KEY`: chave da API Brevo  
  - `RECAPTCHA_SITE_KEY` e `RECAPTCHA_SECRET_KEY`

### Passos

1. **Clonar repositório**  
   ```bash
   git clone https://github.com/seu-usuario/Locacao.git
   cd Locacao
   ```

2. **Configurar ambiente**  
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```  
   Ajuste `.env` com as credenciais do banco, Brevo e reCAPTCHA.

3. **Instalar dependências PHP**  
   ```bash
   composer install
   php artisan migrate
   ```

4. **Instalar dependências JavaScript**  
   ```bash
   npm install
   
   ```

5. **Executar aplicação**  
   Em uma aba/terminal, rode o servidor Laravel:  
   ```bash
   php artisan serve
   ```  
   Em outra aba/terminal, rode o build de front-end:  
   ```bash
   npm run dev
   ```

6. **Acessar**  
   Abra `http://127.0.0.1:8000` ou `localhost:8000` no navegador.
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
