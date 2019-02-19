<?php

namespace Test\Unit\Core;

use Core\Engineer;
use Core\UAE;
use PHPUnit\Framework\TestCase;

/**
 * Class UAETest.
 *
 * @package Test\Core
 */
class UAETest extends TestCase
{
    /** @var Engineer */
    protected $class;

    /** Setup Method */
    public function setUp()
    {
        $engineer = $this->getMockBuilder(Engineer::class)
            ->setMethods(['getBasicSalary'])
            ->getMock();

        $engineer->expects($this->any())
            ->method('getBasicSalary')
            ->willReturn(6000);

        $this->class = (new UAE())->setEmployee($engineer);
    }

    /**
     * Test tax value of 20.
     */
    public function testTaxValue20()
    {
        $engineer = $this->getMockBuilder(Engineer::class)
            ->setMethods(['getBasicSalary', 'getKids'])
            ->getMock();

        $engineer->expects($this->any())
            ->method('getBasicSalary')
            ->willReturn(6000);


        $engineer->expects($this->any())
            ->method('getKids')
            ->willReturn(2);

        $class = (new UAE())->setEmployee($engineer);

        $this->assertEquals(20, $class->calculateTax());
    }

    /**
     * Test tax value of 18.
     */
    public function testTaxValue18()
    {
        $engineer = $this->getMockBuilder(Engineer::class)
            ->setMethods(['getBasicSalary', 'getKids'])
            ->getMock();

        $engineer->expects($this->any())
            ->method('getBasicSalary')
            ->willReturn(5000);


        $engineer->expects($this->any())
            ->method('getKids')
            ->willReturn(3);

        $class = (new UAE())->setEmployee($engineer);

        $this->assertEquals(18, $class->calculateTax());
    }

    /**
     * Test wrong tax value.
     */
    public function testWrongTaxValue18()
    {
        $engineer = $this->getMockBuilder(Engineer::class)
            ->setMethods(['getBasicSalary', 'getKids'])
            ->getMock();

        $engineer->expects($this->any())
            ->method('getBasicSalary')
            ->willReturn(4000);


        $engineer->expects($this->any())
            ->method('getKids')
            ->willReturn(3);

        $class = (new UAE())->setEmployee($engineer);

        $this->assertNotEquals(20, $class->calculateTax());
    }
}