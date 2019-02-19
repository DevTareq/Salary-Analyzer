<?php

namespace Core\Base;

use App\Core\Data\Constants;
use Core\Contracts\EmployeeInterface;
use Core\UAE;

/**
 * Class CountryTaxFactory
 *
 * @package Core\Base
 */
class CountryTaxFactory
{
    /**
     * CountryTaxFactory constructor.
     */
    private function __construct() {}

    /**
     * Generate Country Tax.
     *
     * @param string $country
     * @param EmployeeInterface $employee
     * @return TaxableCountry
     * @throws \Exception
     */
    public static function generate(string $country, EmployeeInterface $employee)
    {
        $country = "Core\\" . strtoupper($country);

        if (!class_exists($country)) {
            throw new \Exception("Country not found!", 400);
        }

        return (new $country())->setEmployee($employee);
    }
}