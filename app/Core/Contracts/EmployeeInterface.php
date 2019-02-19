<?php

namespace Core\Contracts;

/**
 * Interface EmployeeInterface
 */
interface EmployeeInterface
{
    /**
     * @param int $value
     *
     * @return EmployeeInterface
     */
    public function setBasicSalary(int $value): EmployeeInterface;

    /**
     * @return int
     */
    public function getBasicSalary(): int;
}