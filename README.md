# 🧾 BillApp — Modern Billing & Invoice Management System

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11%2B-red?style=for-the-badge&logo=laravel" alt="Laravel 11+">
  <img src="https://img.shields.io/badge/Livewire-v3-4f46e5?style=for-the-badge&logo=livewire" alt="Livewire v3">
  <img src="https://img.shields.io/badge/Tailwind_CSS-v4-06b6d4?style=for-the-badge&logo=tailwind-css" alt="Tailwind CSS v4">
  <img src="https://img.shields.io/badge/PHP-8.4-777bb4?style=for-the-badge&logo=php" alt="PHP 8.4">
  <img src="https://img.shields.io/badge/Docker-Ready-2496ed?style=for-the-badge&logo=docker" alt="Docker Ready">
</p>

**BillApp** is a self-hosted, lightweight, and modern invoicing application designed for business owners and freelancers. It offers dynamic invoice creation, product catalog management, custom invoice number sequencing, and regional font PDF generation (such as Gujarati fonts). It also provides a seamless way to share secure download links with clients over WhatsApp or SMS.

---

## ✨ Key Features

- **📊 Dynamic Dashboard:** Get an overview of your sales metrics, invoice counts, and client activity in real-time.
- **🛍️ Product Management:** Maintain a reusable catalog of products with prices and support for custom metrics (e.g., *Kg*, *Pcs*, *Mtr*).
- **🧾 Flexible Bill Series:** Support for automatic, user-customized invoice numbering using custom prefixes (e.g., `INV-2026-`).
- **🔤 Regional Font PDF Support:** Seamless PDF generation powered by `mPDF`. Fully supports Unicode characters and custom regional fonts (e.g., Gujarati) uploaded directly by the user.
- **🔗 WhatsApp & Public Sharing:** Generate unique, secure links (`/invoice/{token}`) to share with clients. Clients can preview the invoice in a beautiful mobile-responsive screen and download the PDF directly without authentication.
- **🔑 Google OAuth Login:** Quick sign-in using Google accounts (powered by Laravel Socialite) alongside standard password authentication.
- **🐳 Multi-Stage Dockerization:** Optimized production-ready `Dockerfile` using multi-stage builds and SQLite, making it plug-and-play for platforms like Render or Heroku.

---

## 🛠️ Tech Stack

- **Backend:** Laravel 11.x, PHP 8.4
- **Frontend:** Livewire v3, Alpine.js, Tailwind CSS v4, Flowbite
- **PDF Generation:** mPDF 8.x (with custom cache directory configurations for read-only systems)
- **Authentication:** Laravel Breeze, Laravel Socialite (Google Sign-In)
- **Database:** SQLite (default/production), MySQL support available

---

## 📂 Project Architecture & Key Directories

```yaml
app/
 ├── Http/
 │    └── Controllers/
 │         ├── AuthController.php        # Default authentication actions
 │         ├── BillPdfController.php     # PDF compiling, public previews, and streaming
 │         └── GoogleAuthController.php   # Google OAuth callback & user provisioning
 ├── Livewire/                           # Core Livewire v3 components
 │    ├── Auth/                          # Login and Register reactive panels
 │    ├── Bill/                          # Bill listing and invoice builder (BillForm)
 │    ├── Dashboard/                     # Sales statistics widgets
 │    ├── Forms/                         # Livewire Form Objects separating state & validation
 │    ├── Product/                       # Product inventory control
 │    └── Setting/                       # Company profile, bank information, & font settings
 └── Models/
      ├── User.php                       # User model
      ├── Setting.php                    # Company metadata, bank accounts, and invoice style configs
      ├── Product.php                    # Product definition details
      ├── Bill.php                       # Bill metadata (date, customer name, total, tokens)
      ├── BillProduct.php                # Pivot table items mapped to invoices (quantity, size, unit)
      └── BillSeries.php                 # Current prefix and tracking index for bill numbering
```

---

## ⚙️ Local Development Setup

### Prerequisites
- PHP >= 8.2 (with `gd`, `zip`, `sqlite3`, `intl`, `bcmath` extensions enabled)
- Composer
- Node.js & NPM
- SQLite (or MySQL)

### Installation Steps

1. **Clone the Repository:**
   ```bash
   git clone <repository-url>
   cd bill-app
   ```

2. **Install PHP & Node Dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment File:**
   Copy the example environment file:
   ```bash
   cp .env.example .env
   ```
   *Note: Ensure `DB_CONNECTION` is set to `sqlite` for zero-configuration, or fill out your MySQL parameters.*

4. **Initialize SQLite Database:**
   ```bash
   # Create a blank SQLite file if using SQLite
   touch database/database.sqlite
   ```

5. **Generate App Key & Run Migrations:**
   ```bash
   php artisan key:generate
   php artisan migrate
   ```

6. **Build Asset Bundle:**
   ```bash
   npm run build
   ```

7. **Start Development Server:**
   ```bash
   php artisan serve
   # In another terminal window:
   npm run dev
   ```
   Open `http://localhost:8000` in your web browser.

---

## 🔑 Google Authentication Configuration

To enable Google login, ensure you have set up a project in the Google Cloud Console and added the redirect URI: `http://localhost:8000/auth/google/callback`.

Then, add the credentials to your `.env` file:
```env
GOOGLE_CLIENT_ID="your-google-client-id"
GOOGLE_CLIENT_SECRET="your-google-client-secret"
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
```

---

## 🐳 Running with Docker

This project comes ready with an optimized, multi-stage `Dockerfile` suitable for production deployments.

### Local Build and Run
1. **Build the Image:**
   ```bash
   docker build -t bill-app .
   ```

2. **Run the Container:**
   ```bash
   docker run -p 8080:80 \
     -e APP_KEY="Base64EncodedKeyHere..." \
     -e DB_CONNECTION=sqlite \
     -e APP_ENV=production \
     bill-app
   ```
   The application will be accessible at `http://localhost:8080`.

---

## 🚀 Production Deployment on Render

This project is pre-configured for direct deployments on **Render.com** (using the Web Service option with Docker runtime).

1. **Deploy Settings on Render:**
   - **Runtime:** `Docker`
   - **Environment Variables:**
     - `APP_KEY`: *(Generate a secure key using `php artisan key:generate --show`)*
     - `DB_CONNECTION`: `sqlite`
     - `APP_ENV`: `production`
     - `APP_DEBUG`: `false`
     - `APP_URL`: `https://your-app-name.onrender.com`
2. **Persistent Disk Storage:**
   To persist SQLite database files and uploaded custom fonts/logos across redeployments:
   - Add a Render Disk and mount it to `/var/www/html/storage`.
   - The included `entrypoint.sh` automatically provisions the SQLite database under `/var/www/html/database/database.sqlite` (or points directly to your mounted path if configured).

---

## 🔏 Custom Font (Gujarati / regional) Setup
For generating bills with regional scripts like Gujarati, navigate to the **Settings** page:
1. Enable the **"Use Gujarati Font"** switch.
2. Upload a custom TrueType Font (`.ttf` file) containing the script glyphs.
3. The system will store the font in `storage/app/public` and load it dynamically during invoice compilation using mPDF's configuration settings.

---

## 📄 License
This application is open-source software licensed under the [MIT License](https://opensource.org/licenses/MIT).
