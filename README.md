1. Clone the repository: git clone https://github.com/Dimitrijevs/larablogs.git

2. Navigate into the project directory: cd larablogs

3. Install PHP dependencies using Composer: composer install

4. Install Node.js dependencies: npm install

5. Copy the example environment configuration file to `.env`: cp .env.example .env

6. Generate the application key: php artisan key:generate

7. Set up your database configuration in the `.env` file:

- Open `.env` and update the following database settings to match your local database setup:

  ```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=your_database_name
  DB_USERNAME=your_database_user
  DB_PASSWORD=your_database_password
  ```

Replace `your_database_name`, `your_database_user`, and `your_database_password` with your actual database credentials.

8. Run the migrations to create the database tables: php artisan migrate

9. Run the command to refresh the database, running migrations and seeders together: php artisan blog:fresh

10. Generate assets: npm run build

11. Start the development server: php artisan serve

12. Open the project in your browser: open in a browser: http://localhost:8000
