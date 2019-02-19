<?php

namespace Test\Unit\Analyzers;

use Core\Analyzers\KidsAnalyzer;
use Core\Contracts\SalariedInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class KidsAnalyzerTest.
 *
 * @package Test\Analyzers
 */
class KidsAnalyzerTest extends TestCase
{
    /** @var KidsAnalyzer */
    protected $class;

    /** Setup Method */
    public function setUp()
    {
        //
    }

    /**
     * Test has kids fixed amount.
     */
    public function testHasKidsFixedPrice()
    {
        $this->assertEquals(0, $this->getObject(0)->setIsFixedPrice(true)->getValue());
    }

    /**
     * Test has kids percentage amount.
     */
    public function testHasKidsPercentage()
    {
        $this->assertEquals(0, $this->getObject(0)->getValue());
    }

    /**
     * Test has kids default amount.
     */
    public function testHasKidsDefaultValue()
    {
        $this->assertEquals(0, $this->getObject(0)->getValue());
    }

    /**
     * Test has kids less than zero.
     */
    public function testHasKidsLessThanZero()
    {
        $this->assertEquals(0, $this->getObject(-1)->getValue());
    }

    /**
     * @param $kids
     * @return SalariedInterface
     */
    private function getObject($kids): SalariedInterface
    {
        return $this->class = new KidsAnalyzer($kids);
    }
}