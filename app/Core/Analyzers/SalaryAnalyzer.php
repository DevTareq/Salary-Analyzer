<?php
namespace Core\Analyzers;

use Core\Base\TaxableCountry;
use Core\Contracts\EmployeeInterface;
use Core\Contracts\SalariedInterface;

/**
 * Class SalaryAnalyzer
 */
class SalaryAnalyzer
{
    /**
     * @var EmployeeInterface
     */
    protected $employee;

    /**
     * @var float
     */
    protected $netSalary;

    /**
     * @var TaxableCountry
     */
    protected $country;

    /**
     * @param EmployeeInterface $employee
     *
     * @return $this
     */
    public function setEmployee(EmployeeInterface $employee)
    {
        $this->employee  = $employee;
        $this->netSalary = $employee->getBasicSalary();

        return $this;
    }

    /**
     * Country setter.
     *
     * @param $value
     *
     * @return $this
     */
    public function setCountry(TaxableCountry $value)
    {
        $this->country = $value;

        return $this;
    }

    /**
     * Country getter.
     *
     * @return TaxableCountry
     */
    public function getCountry(): TaxableCountry
    {
        return $this->country;
    }

    /**
     * Handle kids setter.
     *
     * @param SalariedInterface $vacation
     *
     * @return $this
     */
    public function handleKids(SalariedInterface $vacation)
    {
        $this->decrease($vacation);

        return $this;
    }

    /**
     * Age setter.
     *
     * @param SalariedInterface $value
     *
     * @return $this
     */
    public function handleAge(SalariedInterface $value)
    {
        $this->increase($value);

        return $this;
    }

    /**
     * Handle car setter.
     *
     * @param SalariedInterface $value
     *
     * @return $this
     */
    public function handleCar(SalariedInterface $value)
    {
        $this->decrease($value);

        return $this;
    }

    /**
     * Calculate salary.
     *
     * @return float
     */
    public function calculateSalary(): float
    {
        $this->addCountryTax();

        return $this->netSalary;
    }

    /**
     * Increase setter.
     * Increase salary amount.
     *
     * @param SalariedInterface $interface
     *
     * @return mixed
     */
    private function increase(SalariedInterface $interface)
    {
        if ($interface->getValue() == 0) {
            return $this->netSalary;
        }

        if ($interface->getIsFixedPrice()) {
            return $this->netSalary += $interface->getValue();
        }

        return $this->netSalary += ($this->netSalary * ($interface->getValue() / 100));
    }

    /**
     * Decrease setter.
     * Decrease salary amount.
     *
     * @param SalariedInterface $interface
     *
     * @return mixed
     */
    private function decrease(SalariedInterface $interface)
    {
        if ($interface->getValue() == 0) {
            return $this->netSalary;
        }

        if ($interface->getIsFixedPrice()) {
            return $this->netSalary -= $interface->getValue();
        }

        return $this->netSalary -= ($this->netSalary * ($interface->getValue() / 100));
    }

    /**
     * Country Tax injector.
     *
     * @return float|int
     */
    private function addCountryTax()
    {
        return $this->netSalary -= ($this->netSalary * $this->getCountry()->calculateTax() / 100);
    }
}