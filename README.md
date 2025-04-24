# Commission Fee Calculator

This project is a PHP-based application for calculating commission fees for financial transactions. It includes features such as currency conversion, transaction processing, and parameter validation.

## Features

- **Currency Conversion**: Converts amounts between different currencies using exchange rates.
- **Transaction Processing**: Handles deposit and withdrawal operations with commission fee calculations.
- **Parameter Validation**: Validates CLI input parameters for proper execution.

## Requirements

- PHP 8.1 or higher
- Composer
- Docker (for containerized environment)

## Installation

1. Clone the repository:
   ```bash
   gh repo clone DeSKot/test-commission-fee-charge-calculator
   cd test-commission-fee-charge-calculator/app
    ```
2. Create .env:
    ```bash
    cp env.example .env
    ```
3. Run Docker:
    ```bash
    docker-compose up -d
    ```
4. Enter into the container:
    ```bash
    docker exec -it php-cli bash
    ```
5. Install dependencies:
    ```bash
    composer install
    ```
## Run commands
- To run the application:
    ```bash
    php main.php /app/tests/fixtures/input.csv
    ```
- Run tests:
    ```bash
    composer run-script phpunit .
    ```