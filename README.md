<p align="center">
    <a href="https://laravel.com" target="_blank">
        <strong style="font-size: 40px">CARD API</strong>
    </a>
</p>

## About Card API

Card API is a restful API built with Laravel 10 following the best practices recommended by Laravel Docs, expressive code, and making sure my code could work great under 100 requests per second.

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

