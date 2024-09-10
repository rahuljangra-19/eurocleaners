## Installation

- Clone the project from the github repository
- Copy the .env file: `cp .env.example .env`
- Change permissions: `chmod -R 777 storage` and `chmod -R 777 bootstrap/cache`
- Run docker: `docker compose up -d `
- Enter the container: `docker exec -it php bash`
- Install dependencies: `composer install`
- Generate the application key: `php artisan key:generate`
- Update the database: `php artisan migrate:fresh --seed`

## How to access the application
You need to create a virtual host locally: `eurocleaners-gr.local` and then
the project will be available under the address: https://eurocleaners-gr.local/

The phpmyadmin will be under: http://localhost:8080/

And the nova admin panel can be accessed here: http://eurocleaners-gr.local/admin/login with
email: `dev@eurocleaners.gr` and password: `123456789` as seen in the UserSeeder class.


