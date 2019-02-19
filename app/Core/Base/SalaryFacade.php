<?php

namespace Core\Base;

use App\Core\Data\Constants;
use Core\Analyzers\AgeAnalyzer;
use Core\Analyzers\CarAnalyzer;
use Core\Analyzers\KidsAnalyzer;
use Core\Analyzers\SalaryAnalyzer;
use Core\Contracts\CountryInterface;
use Core\Contracts\EmployeeInterface;

/**
 * Class SalaryFacade.
 *
 * @property float salary
 * @property CountryInterface country
 *
 * @package Core\Base
 */
class SalaryFacade
{
    /**
     * @var EmployeeInterface
     */
    private $employee;

    /**
     * @var EmployeeInterface
     */
    private $countryShortCode = Constants::UAE_COUNTRY;

    /**
     * SalaryFacade constructor.
     * @param EmployeeInterface $employee
     */
    public function __construct(EmployeeInterface $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Calculate employee salary.
     *
     * @return $this
     * @throws \Exception
     */
    public function calculate()
    {
        $kids = (new KidsAnalyzer($this->employee->getKids()));
        $age  = (new AgeAnalyzer($this->employee->getAge()));
        $car  = (new CarAnalyzer())->setIsFixedPrice(true);

        $country = CountryTaxFactory::generate($this->getCountryShortCode(), $this->employee);

        /** @var SalaryAnalyzer $salaryAnalyzer */
        $salaryAnalyzer = new SalaryAnalyzer();

        $salaryAnalyzer->setEmployee($this->employee)
            ->setCountry($country)
            ->handleAge($age)
            ->handleKids($kids);

        if ($this->employee->getHasCar()) {
            $salaryAnalyzer->handleCar($car);
        }

        $this->setSalary($salaryAnalyzer->calculateSalary());
        $this->setCountry($country);

        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    private function setSalary($value)
    {
        $this->salary = $value;

        return $this;
    }

    /**
     * @return float
     */
    public function getSalary()
    {
        return $this->salary;

    }

    /**
     * @param $value
     * @return $this
     */
    private function setCountry($value)
    {
        $this->country = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Country short code setter.
     *
     * @param string $value
     * @return SalaryFacade
     */
    public function setCountryShortCode(string $value): self
    {
        $this->countryShortCode = $value;

        return $this;
    }

    /**
     * Country short code setter.
     *
     * @return string
     */
    public function getCountryShortCode(): string
    {
        return $this->countryShortCode;
    }
}