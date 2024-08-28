# Laravel Inventory Management System

This is a Laravel-based Inventory Management System that allows users to manage items, suppliers, and roles.

## Features

- User authentication and authorization
- Role-based access control
- CRUD operations for items and suppliers
- Image upload for items

## Requirements

- PHP >= 8.2
- Composer
- Laravel 11.x
- MySQL or any other supported database

## Installation

1. Clone the repository:

    ```sh
    git clone https://github.com/justinangeloperez327/laravel-inventory.git
    cd laravel-inventory
    ```

2. Install dependencies:

    ```sh
    composer install
    npm install
    npm run dev
    ```

3. Copy the `.env.example` file to `.env` and configure your environment variables:

    ```sh
    cp .env.example .env
    ```

4. Generate an application key:

    ```sh
    php artisan key:generate
    ```

5. Run the migrations and seed the database:

    ```sh
    php artisan migrate --seed
    ```

6. Serve the application:

    ```sh
    php artisan serve
    ```

## Usage

- Register a new user or log in with an existing account.
- Manage items and suppliers through the dashboard.
- Assign roles to users for role-based access control.

### Controllers

- `ItemController.php`: Handles CRUD operations for items.
- `SupplierController.php`: Handles CRUD operations for suppliers.

### Models

- `Item.php`: Represents an item in the inventory.
- `Supplier.php`: Represents a supplier.

### Policies

- `ItemPolicy.php`: Defines authorization logic for items.
- `SupplierPolicy.php`: Defines authorization logic for suppliers.

### Requests

- `StoreItemRequest.php`: Validates the request data for storing an item.
- `UpdateItemRequest.php`: Validates the request data for updating an item.

## License

This project is open-source and available under the [MIT License](LICENSE).

## Contact

For any inquiries, please contact [justinangeloperez327@gmail.com](mailto:your-email@example.com).
