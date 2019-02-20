## Salary Analyzer

* Introduction
  - Build an application which will calculate salary for employees.
  - Build an expandable system of bonuses or deductions.
  - Beep in mind OOP, software design patterns, code architecture, tests and accuracy in implementation during developing.

* Conditions
   - Country Tax for salaries is 20%
   - If an employee older than 50 we want to add 7% to his salary.
   - If an employee has more than 2 kids we want to decrease his Tax by 2%.
   - If an employee wants to use a company car we need to deduct $500.
   
* Initial data

   - Alice is 26 years old, she has 2 kids and her salary is $6k
   - Bob is 52, he is using a company car and his salary is $4k
   - Charlie is 36, he has 3 kids, company car and his salary is $5k

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

    
