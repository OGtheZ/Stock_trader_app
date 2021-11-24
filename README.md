Welcome to the stock trading app made and designed by me!

To use this app, you will need to register on Finnhub.io and acquire an API key.
When said key has been acquired add it in the .end file create the name FINNHUB_API_KEY or simply use the template in .env.example.
 
The use of eloquent models is in practice in this application, and it requires a database with a connection.
Configure your database connection within the .env file. This application uses MySQL for the database.

Run composer install and npm install in the terminal before beginning work with the application.

Make sure to run php artisan migrate, to create all necessary tables in the database.

Setup your mailing services in the .env file.
The emails are automated, and You will need to run php artisan queue:listen to run jobs and send the emails.

