<?php

namespace Test\Unit\Analyzers;

use Core\Analyzers\AgeAnalyzer;
use Core\Analyzers\CarAnalyzer;
use Core\Analyzers\KidsAnalyzer;
use Core\Analyzers\SalaryAnalyzer;
use Core\Engineer;
use Core\UAE;
use PHPUnit\Framework\TestCase;

/**
 * Class SalaryAnalyzerTest.
 *
 * @package Test\Analyzers
 */
class SalaryAnalyzerTest extends TestCase
{
    /** @var SalaryAnalyzer */
    protected $class;

    /** @var bool */
    protected $hasCar = false;

    /**
     * Test tax:20, Age less than 50, kids: equals 2, no car
     */
    public function testTax20AgeLessThan50KidsLessThan2NoCar()
    {
        $country = $this->createMock(UAE::class);
        $country->method('calculateTax')
            ->willReturn(20);


        $ageAnalyzer = $this->getMockBuilder(AgeAnalyzer::class)
            ->setMethods(['getValue'])
            ->getMock();

        $ageAnalyzer->expects($this->any())
            ->method('getValue')
            ->willReturn(0);


        $kidsAnalyzer = $this->getMockBuilder(KidsAnalyzer::class)
            ->setMethods(['getValue'])
            ->getMock();

        $kidsAnalyzer->expects($this->any())
            ->method('getValue')
            ->willReturn(0);


        $engineer = $this->getMockBuilder(Engineer::class)
            ->setMethods(['getBasicSalary'])
            ->getMock();

        $engineer->expects($this->any())
            ->method('getBasicSalary')
            ->willReturn(6000);


        $salaryAnalyzer = (new SalaryAnalyzer())->setEmployee($engineer)
            ->setCountry($country)
            ->handleAge($ageAnalyzer)
            ->handleKids($kidsAnalyzer);

        if ($this->hasCar) {
            $carAnalyzer = $this->getMockBuilder(CarAnalyzer::class)
                ->setMethods(['getValue'])
                ->getMock();

            $carAnalyzer->expects($this->once())
                ->method('getValue')
                ->willReturn(0);

            $carAnalyzer = $this->createMock(CarAnalyzer::class);

            $salaryAnalyzer->handleCar($carAnalyzer);
        }

        $this->assertEquals(4800.0, $salaryAnalyzer->calculateSalary());
    }

    /**
     * Test tax:20, Age more than 50, kids: less than 2, has a car
     */
    public function testTax20AgeMoreThan50KidsLessThan2HasCar()
    {
        $country = $this->createMock(UAE::class);
        $country->method('calculateTax')
            ->willReturn(20);


        $ageAnalyzer = $this->getMockBuilder(AgeAnalyzer::class)
            ->setMethods(['getValue'])
            ->getMock();

        $ageAnalyzer->expects($this->any())
            ->method('getValue')
            ->willReturn(7);


        $kidsAnalyzer = $this->getMockBuilder(KidsAnalyzer::class)
            ->setMethods(['getValue'])
            ->getMock();

        $kidsAnalyzer->expects($this->any())
            ->method('getValue')
            ->willReturn(0);


        $engineer = $this->getMockBuilder(Engineer::class)
            ->setMethods(['getBasicSalary'])
            ->getMock();

        $engineer->expects($this->any())
            ->method('getBasicSalary')
            ->willReturn(4000);


        $carAnalyzer = $this->getMockBuilder(CarAnalyzer::class)
            ->setMethods(['getValue', 'getIsFixedPrice'])
            ->getMock();

        $carAnalyzer->expects($this->any())
            ->method('getValue')
            ->willReturn(500);

        $carAnalyzer->expects($this->any())
            ->method('getIsFixedPrice')
            ->willReturn(true);


        $salaryAnalyzer = (new SalaryAnalyzer())->setEmployee($engineer)
            ->setCountry($country)
            ->handleAge($ageAnalyzer)
            ->handleKids($kidsAnalyzer)
            ->handleCar($carAnalyzer);


        $this->assertEquals(3024.0, $salaryAnalyzer->calculateSalary());
    }

    /**
     * Test tax:18, Age less than 50, kids: more than 2, has a car
     */
    public function testTax18AgeLessThan50KidsMoreThan2HasCar()
    {
        $country = $this->createMock(UAE::class);
        $country->method('calculateTax')
            ->willReturn(18);

        $ageAnalyzer = $this->getMockBuilder(AgeAnalyzer::class)
            ->setMethods(['getValue'])
            ->getMock();

        $ageAnalyzer->expects($this->any())
            ->method('getValue')
            ->willReturn(0);


        $kidsAnalyzer = $this->getMockBuilder(KidsAnalyzer::class)
            ->setMethods(['getValue'])
            ->getMock();

        $kidsAnalyzer->expects($this->any())
            ->method('getValue')
            ->willReturn(0);

        $engineer = $this->getMockBuilder(Engineer::class)
            ->setMethods(['getBasicSalary'])
            ->getMock();

        $engineer->expects($this->any())
            ->method('getBasicSalary')
            ->willReturn(5000);

        $carAnalyzer = $this->getMockBuilder(CarAnalyzer::class)
            ->setMethods(['getValue', 'getIsFixedPrice'])
            ->getMock();

        $carAnalyzer->expects($this->any())
            ->method('getValue')
            ->willReturn(500);

        $carAnalyzer->expects($this->any())
            ->method('getIsFixedPrice')
            ->willReturn(true);


        $salaryAnalyzer = (new SalaryAnalyzer())->setEmployee($engineer)
            ->setCountry($country)
            ->handleAge($ageAnalyzer)
            ->handleKids($kidsAnalyzer)
            ->handleCar($carAnalyzer);

        $this->assertEquals(3690.0, $salaryAnalyzer->calculateSalary());
    }
}