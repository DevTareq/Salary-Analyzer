<?php

namespace Test\Integration;

use App\Core\Data\Constants;
use Core\Analyzers\AgeAnalyzer;
use Core\Analyzers\CarAnalyzer;
use Core\Analyzers\KidsAnalyzer;
use Core\Analyzers\SalaryAnalyzer;
use Core\Base\CountryTaxFactory;
use Core\Contracts\EmployeeInterface;
use Core\Engineer;
use PHPUnit\Framework\TestCase;

/**
 * Class SalaryFacadeTest.
 *
 * @package Test\Integration
 */
class SalaryFacadeTest extends TestCase
{

    /** Test Alice Example in UAE */
    public function testAliceInUAECountry()
    {
        /** @var EmployeeInterface $employee */
        $employee = (new Engineer())
            ->setBasicSalary(6000)
            ->setName('Alice')
            ->setAge(26)
            ->setKids(2)
            ->setHasCar(false);

        $kids = (new KidsAnalyzer($employee->getKids()));
        $age = (new AgeAnalyzer($employee->getAge()));
        $car = (new CarAnalyzer())->setIsFixedPrice(true);

        $country = CountryTaxFactory::generate(Constants::UAE_COUNTRY, $employee);

        /** @var SalaryAnalyzer $salaryAnalyzer */
        $salaryAnalyzer = new SalaryAnalyzer();

        $salaryAnalyzer->setEmployee($employee)
            ->setCountry($country)
            ->handleAge($age)
            ->handleKids($kids);

        if ($employee->getHasCar()) {
            $salaryAnalyzer->handleCar($car);
        }

        $this->assertEquals(4800.0, $salaryAnalyzer->calculateSalary());
        $this->assertEquals('AED', $salaryAnalyzer->getCountry()->getCurrency());
    }

    /** Test Bob Example in UAE */
    public function testBobInUAECountry()
    {
        /** @var EmployeeInterface $employee */
        $employee = (new Engineer())
            ->setBasicSalary(4000)
            ->setName('Bob')
            ->setAge(52)
            ->setHasCar(true);

        $kids = (new KidsAnalyzer($employee->getKids()));
        $age = (new AgeAnalyzer($employee->getAge()));
        $car = (new CarAnalyzer())->setIsFixedPrice(true);

        $country = CountryTaxFactory::generate(Constants::UAE_COUNTRY, $employee);

        /** @var SalaryAnalyzer $salaryAnalyzer */
        $salaryAnalyzer = new SalaryAnalyzer();

        $salaryAnalyzer->setEmployee($employee)
            ->setCountry($country)
            ->handleAge($age)
            ->handleKids($kids);

        if ($employee->getHasCar()) {
            $salaryAnalyzer->handleCar($car);
        }

        $this->assertEquals(3024.0, $salaryAnalyzer->calculateSalary());
        $this->assertEquals('AED', $salaryAnalyzer->getCountry()->getCurrency());
    }

    /** Test Charlie Example in UAE */
    public function testCharlieInUAECountry()
    {
        /** @var EmployeeInterface $employee */
        $employee = (new Engineer())
            ->setBasicSalary(5000)
            ->setName('Charlie')
            ->setAge(36)
            ->setKids(3)
            ->setHasCar(true);

        $kids = (new KidsAnalyzer($employee->getKids()));
        $age = (new AgeAnalyzer($employee->getAge()));
        $car = (new CarAnalyzer())->setIsFixedPrice(true);

        $country = CountryTaxFactory::generate(Constants::UAE_COUNTRY, $employee);

        /** @var SalaryAnalyzer $salaryAnalyzer */
        $salaryAnalyzer = new SalaryAnalyzer();

        $salaryAnalyzer->setEmployee($employee)
            ->setCountry($country)
            ->handleAge($age)
            ->handleKids($kids);

        if ($employee->getHasCar()) {
            $salaryAnalyzer->handleCar($car);
        }

        $this->assertEquals(3690.0, $salaryAnalyzer->calculateSalary());
        $this->assertEquals('AED', $salaryAnalyzer->getCountry()->getCurrency());
    }

    /** Test Alice Example in Bahrain */
    public function testAliceInBHCountry()
    {
        /** @var EmployeeInterface $employee */
        $employee = (new Engineer())
            ->setBasicSalary(6000)
            ->setName('Alice')
            ->setAge(26)
            ->setKids(2)
            ->setHasCar(false);

        $kids = (new KidsAnalyzer($employee->getKids()));
        $age = (new AgeAnalyzer($employee->getAge()));
        $car = (new CarAnalyzer())->setIsFixedPrice(true);

        $country = CountryTaxFactory::generate(Constants::BH_COUNTRY, $employee);

        /** @var SalaryAnalyzer $salaryAnalyzer */
        $salaryAnalyzer = new SalaryAnalyzer();

        $salaryAnalyzer->setEmployee($employee)
            ->setCountry($country)
            ->handleAge($age)
            ->handleKids($kids);

        if ($employee->getHasCar()) {
            $salaryAnalyzer->handleCar($car);
        }

        $this->assertEquals(5400.0, $salaryAnalyzer->calculateSalary());
        $this->assertEquals('BHD', $salaryAnalyzer->getCountry()->getCurrency());
    }
}