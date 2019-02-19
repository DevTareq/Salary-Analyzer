<?php
namespace Core;

use Core\Contracts\EmployeeInterface;

/**
 * Class Engineer
 */
class Engineer implements EmployeeInterface
{
    /**
     * @var integer
     */
    protected $salary = 0;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $age;

    /**
     * @var int
     */
    protected $kids = 0;

    /**
     * @var bool
     */
    protected $hasCar = false;

    /**
     * Name setter.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setName(string $value)
    {
        $this->name = (string)$value;

        return $this;
    }

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
     * Age setter.
     *
     * @param int $value
     *
     * @return $this
     */
    public function setAge(int $value)
    {
        $this->age = (string)$value;

        return $this;
    }

    /**
     * Age getter.
     *
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * Kids setter.
     *
     * @param int $value
     *
     * @return $this
     */
    public function setKids(int $value)
    {
        $this->kids = (string)$value;

        return $this;
    }

    /**
     * Kids getter.
     *
     * @return int
     */
    public function getKids(): int
    {
        return $this->kids;
    }

    /**
     * Has car setter.
     *
     * @param bool $value
     *
     * @return $this
     */
    public function setHasCar(bool $value)
    {
        $this->hasCar = $value;

        return $this;
    }

    /**
     * Has car getter.
     *
     * @return bool
     */
    public function getHasCar(): bool
    {
        return $this->hasCar;
    }

    /**
     * Basic salary setter.
     *
     * @param int $salary
     *
     * @return EmployeeInterface|mixed
     */
    public function setBasicSalary(int $salary = 15000): EmployeeInterface
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Basic salary setter.
     *
     * @return int
     */
    public function getBasicSalary(): int
    {
        return $this->salary;
    }
}
