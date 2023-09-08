<p align="center">
    <a href="http://project-knot.loisbassey.com" target="_blank">
        <img style="width: 180px" src="https://cdn-icons-png.flaticon.com/512/5502/5502357.png" alt="Card API Logo" />
    </a>
</p>

## About Card API

Card API is a restful API built with Laravel 10 following the best practices recommended by Laravel Docs, expressive code, and making sure my code could work great under 100 requests per second.

## Project Link
http://project-knot.loisbassey.com

## Project Architecture
The Card API project follows a structured and modular architecture that separates concerns effectively. Here's an overview of the key components and their roles:

- **Models:** Models represent the data structures used in the application. They interact with the database and define relationships between data entities.

- **Controllers:** Controllers handle HTTP requests and delegate the application's logic to service classes. They act as a bridge between the incoming HTTP requests and the underlying services.

- **Service Classes:** Service classes contain the core business logic of the application. They encapsulate the operations and functionalities that controllers rely on. This separation of concerns makes your application more maintainable and testable.

### Authentication And Authorisation
**Laravel Passport** is used for implementing token-based authentication to secure routes within the API project. It allows the application to issue API tokens for users and authenticate requests using these tokens.

### List of API Endpoints
Here's a list of the main API endpoints available in this project:

- POST /api/auth/register: Create a new user account. 
- POST /api/auth/login: Log into an already created user account. 
- GET /api/card/{uuid}: Get a single card. 
- POST /api/card/create: Create a card. 
- GET /merchants/{uuid}: Get a single merchant by its UUID. 
- POST /merchants/create: Create a merchant. 
- POST /task/create: Create a task. 
- POST /task/{uuid}/update: Update an already created task by its UUID. 
- GET /user/{uuid}/finished-tasks/latest: Get the latest finished tasks of a user grouped by its merchant_id. 
- DELETE /api/users/{id}: Delete a user by their ID.

### Use PostMan
Link To PostMan API Documentation & Definition For This API

https://www.postman.com/thatladydev/workspace/knotapi/api/e1d0d16e-acfb-440d-aa1f-0ee049730e7c?action=share&creator=6272063

## How To Run This Application Locally
### Prerequisites
Before you begin, make sure you have the following prerequisites installed on your system:

- PHP (>= 8.1)
- Composer 
- MySQL database

### API Endpoints

- User Endpoints
- Card Endpoints
- Merchants Endpoints
- Card Switcher Endpoints

### How To Set Up This Application Locally

#### Step 1

Clone this project to your local machine (_make sure you have git installed already on your machine_)
```
git clone https://github.com/ThatLadyDev/Card-API.git
```

#### Step 2
Navigate to the directory containing the project and install the vendor packages needed to run the application.
``` 
cd Card-API
composer install
```

#### Step 3
Copy the contents of the `.env.example` file found in this project into a new file named `.env`
``` 
cp .env.example .env
```

Generate a new application key.
``` 
php artisan key:generate
```

#### Step 4
Using any MySQL database manager of your choice, create a new database that will hold data/information for this project

#### Step 5
Update the .env file created earlier with the details of your just set-up database configuration.
If you are making use of docker, your `DB_HOST` should be set to `mysql`
``` 
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your-db-name
DB_USERNAME=your-db-username
DB_PASSWORD=your-db-password
```

#### Step 6
Migrate and Seed the Database, run database migrations to create the necessary tables.
``` 
php artisan migrate
```

#### Step 7
If you are not using Nginx, serve your application.
``` 
php artisan serve
```

Congratulations! You have successfully installed this project on your local development environment. 
