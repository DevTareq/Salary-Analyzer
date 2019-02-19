<?php
namespace Test\Unit\Analyzers;

use Core\Analyzers\AgeAnalyzer;
use Core\Contracts\SalariedInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class AgeAnalyzerTest.
 *
 * @package Test\Analyzers
 */
class AgeAnalyzerTest extends TestCase
{
    /** @var AgeAnalyzer */
    protected $class;

    /** Setup Method */
    public function setUp()
    {
        //
    }

    /**
     * Test age less than 50.
     */
    public function testAgeLessThan50()
    {
        $this->assertEquals(0, $this->getObject(50)->getValue());
    }

    /**
     * Test age less than 50.
     */
    public function testAgeMoreThan50()
    {
        $this->assertEquals(7, $this->getObject(51)->getValue());
    }

    /**
     * Test age less than zero.
     */
    public function testAgeMoreThanZero()
    {
        $this->assertEquals(0, $this->getObject(-1)->getValue());
    }

    /**
     * Test age has a fixed price value.
     */
    public function testAgeHasFixedValue()
    {
        $obj = $this->getObject(60)->setIsFixedPrice(true);
        $this->assertTrue($obj->getIsFixedPrice());
    }

    /**
     * Test age has a fixed price value and the value is correct.
     */
    public function testAgeFixedPriceValue()
    {
        $this->assertEquals(0, $this->getObject(60)->setIsFixedPrice(true)->getValue());
    }

    /**
     * @param $age
     * @return AgeAnalyzer
     */
    private function getObject($age): SalariedInterface
    {
        return $this->class = new AgeAnalyzer($age);
    }
}