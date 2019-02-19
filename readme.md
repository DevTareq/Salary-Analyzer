# Salary Analyzer

## Installation
## Docker Installation

    * Clone the project 
    * Navigate to the project root folder
    * Build the container `docker-compose build --no-cache`
    * Run `docker-compose up -d`
    * Conncet to the container `docker-compose run web bash` 
    * Run `composer install && composer dumpautoload`
    * Run the CLI Command or the test. (See the CLI Command section)
    
### CLI Command

- `php artisan salaries:calculate`

    - Options:
        - a) Generate 4 pre-defined examples. 
        - b) Calculate your salary with your own custom scenario. 
        
        * Notes: 
            - Country tax will be addded after all deductions, If any.
            - The interactive CLI is not perfect when it comes to input validation, Easy on that.
            - Reading the CLI Command code to start analyzing will be tricky, 
                        Make the Facade in App/Core/Base your starting point.
                        
                
### Tests

- Unit 
    - `./vendor/bin/phpunit tests/Unit`

- Integration 
    - `./vendor/bin/phpunit tests/Integration`
    
- General 
    - `./vendor/bin/phpunit tests`    
    
    
## Old School Installation
    - Clone the project 
    - Go to the project directory 
    - Run `composer install`
    * Run the CLI Command or the test. (See the CLI Command section)
    
- #### Requirements 
  * PHP 7.*

    