<?php

namespace App\Console\Commands;

use App\Core\Data\Constants;
use Core\Base\CountryTaxFactory;
use Core\Base\SalaryFacade;
use Core\Engineer;
use Illuminate\Console\Command;

/**
 * Class SalariesCommand
 *
 * @package App\Console\Commands
 */
class SalariesCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'salaries:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the salaries';

    /**
     * SalariesCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $choice = $this->choice("Do you want to generate our pre-defined fixed examples or input your own custom scenario?",
            [
                'a' => 'Generate the pre-defined examples.',
                'b' => 'Enter my custom scenario. ',
            ], 'a');

        if ($choice == 'a') {

            /** @TODO Note to reviewer: You can start here */
            $this->generateFixedExamples();

        } else {

            $errors = false;

            $this->info("Let's do this and see how much we owe you. \n");

            $name = $this->ask('What is your name?');

            if (!$name || !is_string($name)) {
                $this->error("Please make sure you enter a valid name");
                $errors = true;
            }

            $salary = $this->ask('What is your basic salary?');

            if (!$salary) {
                $this->error("Please make sure you enter a valid salary (Integer)");
                $errors = true;
            }

            $age = $this->ask('How old are you?');

            if (!$age) {
                $this->error("Please make sure you enter a valid age (Integer)");
                $errors = true;
            }

            $kids = $this->ask('How many kids do you have? If none, Please enter 0.');

            if ($kids < 0) {
                $this->error("Please make sure you enter a valid number of kids (Integer)");
                $errors = true;
            }

            $country = $this->choice("Where do you work?",
                [
                    'a' => 'UAE',
                    'b' => 'BH',
                ], 'a');

            if (!$country) {
                $this->error("Please make sure you choose a country");
                $errors = true;
            }


            $car = $this->confirm('Do you use a company car?');


            if (!$errors) {

                try {
                    /** @var Engineer $engineer */
                    $engineer = (new Engineer())
                        ->setBasicSalary($salary)
                        ->setName($name)
                        ->setAge($age);

                    if ($kids > 0) {
                        $engineer->setKids($kids);
                    }

                    if ($car) {
                        $engineer->setHasCar(true);
                    }

                    $countryCode = Constants::UAE_COUNTRY;
                    if ($country == 'b') {
                        $countryCode = Constants::BH_COUNTRY;
                    }

                    $salaryFacade = (new SalaryFacade($engineer))
                        ->setCountryShortCode($countryCode)
                        ->calculate();

                    $this->alert("Your net salary is {$salaryFacade->getSalary()} {$salaryFacade->getCountry()->getCurrency()}");

                } catch (\Exception $e) {
                    $this->error($e->getMessage());
                }

            }

            $this->error("Sorry! You need to make sure you enter the right value.");
        }
    }

    public function generateFixedExamples()
    {
        $this->info("[*] Starting...");
        $this->info("[*] Generating 4 examples..\n");
        $this->comment("Note: All salaries been calculated after the deductions if any..\n");

        $this->aliceExample();
        $this->bobExample();
        $this->charlieExample();
        $this->aliceExampleInBahrain();

        $this->info("[*] Finished. \n");
        $this->comment("Note: All salaries been calculated after the deductions if any..\n");

    }

    /**
     * Fixed example 1
     */
    private function aliceExample()
    {
        $this->info("*) Alice \n - Salary: 6000 \n - Age: 26 \n - Kids: 2 \n - Country Tax: 20% \n - Country: UAE");

        /** @var Engineer $engineer */
        $engineer = (new Engineer())
            ->setBasicSalary(6000)
            ->setName('Alice')
            ->setAge(26)
            ->setKids(2)
            ->setHasCar(false);

        $salaryFacade = (new SalaryFacade($engineer))
            ->setCountryShortCode(Constants::UAE_COUNTRY)
            ->calculate();

        $this->alert("Alice: salary is {$salaryFacade->getSalary()} {$salaryFacade->getCountry()->getCurrency()}");
    }

    /**
     * Fixed example 2
     */
    private function bobExample()
    {
        $this->info("*) Bob \n - Salary: 4000 \n - Age: 52 \n - Car: true \n - Country Tax: 20% \n - Country: UAE");

        /** @var Engineer $engineer */
        $engineer = (new Engineer())
            ->setBasicSalary(4000)
            ->setName('Bob')
            ->setAge(52)
            ->setHasCar(true);

        $salaryFacade = (new SalaryFacade($engineer))
            ->setCountryShortCode(Constants::UAE_COUNTRY)
            ->calculate();

        $this->alert("Bob: salary is {$salaryFacade->getSalary()} {$salaryFacade->getCountry()->getCurrency()}");
    }

    /**
     * Fixed example 3
     */
    private function charlieExample()
    {
        $this->info("*) Charlie \n - Salary: 5000 \n - Age: 36 \n - Kids: 3 \n - Car: true \n - Country Tax: 18% \n - Country: UAE");

        /** @var Engineer $engineer */
        $engineer = (new Engineer())
            ->setBasicSalary(5000)
            ->setName('Charlie')
            ->setAge(36)
            ->setKids(3)
            ->setHasCar(true);

        $salaryFacade = (new SalaryFacade($engineer))
            ->setCountryShortCode(Constants::UAE_COUNTRY)
            ->calculate();

        $this->alert("Charlie: salary is {$salaryFacade->getSalary()} {$salaryFacade->getCountry()->getCurrency()}");
    }

    /**
     * Fixed example 4
     */
    private function aliceExampleInBahrain()
    {
        $this->info("*) Alice \n - Salary: 6000 \n - Age: 26 \n - Kids: 2 \n - Country Tax: 10% \n - Country: BH");

        /** @var Engineer $engineer */
        $engineer = (new Engineer())
            ->setBasicSalary(6000)
            ->setName('Alice')
            ->setAge(26)
            ->setKids(2)
            ->setHasCar(false);

        $salaryFacade = (new SalaryFacade($engineer))
            ->setCountryShortCode(Constants::BH_COUNTRY)
            ->calculate();

        $this->alert("Alice: salary is {$salaryFacade->getSalary()} {$salaryFacade->getCountry()->getCurrency()}");
    }
}