# Micro-Needs

To clone the repository, run:

```
git clone https://github.com/topukhan/micro-needs.git
```

Copy `.env.example` to `.env` and make the necessary changes to connect with your database.
Run the following commands:

```
composer update
php artisan key:generate
php artisan migrate
npm install
npm run build
```

To add default data, run:

```
php artisan db:seed
```

Finally, `php artisan serve` to run the project.

Check the readme file for any additional instructions or if any errors occurred.
