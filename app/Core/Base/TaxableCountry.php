<?php
namespace Core\Base;


use Core\Contracts\EmployeeInterface;

/**
 * Class TaxableCountry.
 *
 * @property float   tax
 * @property integer percentage
 * @property string name
 * @property string currency
 * @property integer fixed
 * @property EmployeeInterface employee
 */
abstract class TaxableCountry
{
    /**
     * @var int $kidsAllowance
     */
    protected $kidsAllowance = 0;

    /**
     * @var int $distanceAllowance
     */
    protected $distanceAllowance = 0;

    /**
     * Name getter.
     *
     * @return string
     */
    public function getName(): string
    {
        return (string)$this->name;
    }

    /**
     * Currency getter.
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return (string)$this->currency;
    }

    /**
     * Kids allowance.
     *
     * @return int
     */
    public function kidsAllowance()
    {
        if ($this->getEmployee()->getKids() > $this->kidsAllowance) {
            $this->tax -= $this->kidsAllowance;
        }

        return $this->tax;
    }

    /**
     * Distance allowance.
     *
     * @return int
     */
    public function distanceAllowance()
    {
        if ($this->getEmployee()->getDistance() > $this->distanceAllowance) {
            $this->tax -= $this->distanceAllowance;
        }

        return $this->tax;
    }

    /**
     * Tax getter.
     *
     * @return mixed
     */
    public function getTax(): int
    {
        return $this->tax;
    }

    /**
     * Kids setter.
     *
     * @param int $value
     *
     * @return TaxableCountry
     */
    public function setKids(int $value): self
    {
        $this->kidsAllowance = $value;

        return $this;
    }

    /**
     * Kids getter.
     *
     * @return int
     */
    public function getKids(): int
    {
        return $this->kidsAllowance;
    }

    /**
     * Distance setter.
     *
     * @param int $value
     *
     * @return $this
     */
    public function setDistance(int $value)
    {
        $this->distanceAllowance = $value;

        return $this;
    }

    /**
     * Distance getter.
     *
     * @return int
     */
    public function getDistance(): int
    {
        return $this->distanceAllowance;
    }

    /**
     * Employee setter.
     *
     * @param EmployeeInterface $value
     *
     * @return TaxableCountry
     */
    public function setEmployee(EmployeeInterface $value): self
    {
        $this->employee = $value;

        return $this;
    }

    /**
     * Employee getter.
     *
     * @return EmployeeInterface
     */
    public function getEmployee(): EmployeeInterface
    {
        return $this->employee;
    }

    /**
     * @return mixed
     */
    abstract public function calculateTax();
}