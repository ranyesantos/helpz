# Project Description
An application for creating and managing support tickets, using AI to generate insights and summaries from technician reports
## Goal
Using AI to provide a clearer view of operations and improve team planning in an automated way.

## Technologies Used
- **Backend:** PHP, Laravel
- **Admin Dashboard:** Filament
- **Database:** MySQL
- **Automated Testing:** Pest PHP
- **CI:** GitHub Actions – for running automated tests

---

# How to Run the Project

Follow the steps below to set up and run this Laravel application

---

## 1. Clone the repository

```bash
git clone https://github.com/ranyesantos/helpz.git
cd helpz
```

---

## 2. Install dependencies

### PHP dependencies

```bash
composer install
```

### JavaScript dependencies

```bash
npm install
```

---

## 3. Set up the environment file

```bash
cp .env.example .env
```

Then update database credentials and other required variables.

Generate the application key:

```bash
php artisan key:generate
```

---

## 4. Run migrations (and seeders if needed)

```bash
php artisan migrate
```

Or with seeders:

```bash
php artisan migrate --seed
```

---

## 5. Start the development server

```bash
composer run dev
```

The application will be available at:

```
http://localhost:8000
```

---

## 6. Run automated tests

To run all tests:

```bash
php artisan test
```
