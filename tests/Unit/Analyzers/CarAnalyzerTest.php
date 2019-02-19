<?php
namespace Test\Unit\Analyzers;

use Core\Analyzers\CarAnalyzer;
use Core\Contracts\SalariedInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class CarAnalyzerTest.
 *
 * @package Test\Analyzers
 */
class CarAnalyzerTest extends TestCase
{
    /** @var CarAnalyzer */
    protected $class;

    /** Setup Method */
    public function setUp()
    {
        //
    }

    /**
     * Test has car is false.
     */
    public function testHasACarIsFalse()
    {
        $this->assertEquals(0, $this->getObject()->getValue());
    }

    /**
     * Test has car default value
     */
    public function testHasCarDefaultValue()
    {
        $this->assertEquals(0, $this->getObject(true)->getValue());
    }

    /**
     * Test has car and fixed price value.
     */
    public function testHasCarAndFixedPrice()
    {
        $obj = $this->getObject(true)->setIsFixedPrice(true);
        $this->assertTrue($obj->getIsFixedPrice());
    }

    /**
     * Test has car price value.
     */
    public function testHasCarValueFixedPriceValue()
    {
        $obj = $this->getObject(true)->setIsFixedPrice(true);
        $this->assertEquals(500, $obj->getValue());
    }

    /**
     * Test has car and and value is percentage.
     */
    public function testHasCarValueFixedPercentage()
    {
        $this->assertEquals(0, $this->getObject(true)->setIsFixedPrice(false)->getValue());
    }

    /**
     * @param bool $value
     * @return SalariedInterface
     */
    private function getObject(bool $value = false): SalariedInterface
    {
        return $this->class = new CarAnalyzer($value);
    }
}