## NuxGame test Task

Task description look in task-description.pdf

## How to run

If you don't have PHP and Composer installed on your local machine, the following commands will install PHP and Composer on Linux:
```bash
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.4)"
```

Prepare project for run:
```bash
npm install &&
npm run build &&
composer install &&
cp .env.example .env &&
php artisan key:generate &&
php artisan migrate
```
For start Laravel's local development server:
```bash
composer run dev
```

