# Micro-Needs

Personal playground to create atomic services/components for learning purpose.

Copy `.env.example` to `.env` and make the necessary changes to connect with your database.
Run the following commands:

```
php artisan key:generate
composer update
npm install
npm run build
```

To add a guest user, run:

```
php artisan db:seed --class=UserSeeder
```

Finally, `php artisan serve` to run the project.
Site URL: [https://microneeds.uupams.com/](https://microneeds.uupams.com/)

Check the readme file for any additional instructions or if any errors occurred.
