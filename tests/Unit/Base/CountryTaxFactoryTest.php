<?php

namespace Test\Unit\Base;

use App\Core\Data\Constants;
use Core\Base\CountryTaxFactory;
use Core\BH;
use Core\Contracts\EmployeeInterface;
use Core\Engineer;
use Core\UAE;
use PHPUnit\Framework\TestCase;

/**
 * Class CountryTaxFactoryTest.
 *
 * @package Test\Analyzers
 */
class CountryTaxFactoryTest extends TestCase
{
    /** @var EmployeeInterface */
    protected $employee;

    /** Setup Method */
    public function setUp()
    {
        $this->employee = $this->createMock(Engineer::class);
    }

    /**
     * Test generating UAE taxable country
     */
    public function testGenerateUAETaxableCountry()
    {

        $country = CountryTaxFactory::generate(Constants::UAE_COUNTRY, $this->employee);
        $this->assertTrue(is_a($country, UAE::class));
    }

    /**
     * Test generating BH taxable country
     */
    public function testGenerateBHTaxableCountry()
    {

        $country = CountryTaxFactory::generate(Constants::BH_COUNTRY, $this->employee);
        $this->assertTrue(is_a($country, BH::class));
    }

    /**
     * Test generating UAE taxable country in lower case
     */
    public function testGenerateUAETaxableCountryLowerCase()
    {
        $country = CountryTaxFactory::generate('uae', $this->employee);
        $this->assertTrue(is_a($country, UAE::class));
    }

    /**
     * Test generating UAE taxable country in lower case
     */
    public function testGenerateWrongUAETaxableCountryLowerCase()
    {
        $this->expectExceptionCode(400);

        CountryTaxFactory::generate('United Arab Emirates', $this->employee);
    }
}