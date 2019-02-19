<?php

namespace Test\Unit\Analyzers;

use App\Core\Data\Constants;
use Core\Base\CountryTaxFactory;
use Core\BH;
use Core\Contracts\EmployeeInterface;
use Core\Engineer;
use Core\UAE;
use PHPUnit\Framework\TestCase;

/**
 * Class EngineerTest.
 *
 * @package Test\Analyzers
 */
class EngineerTest extends TestCase
{
    /** @var Engineer */
    protected $class;

    /** Setup Method */
    public function setUp()
    {
        $this->class = (new Engineer())->setAge(50);

    }

    /**
     * Test age.
     */
    public function testAge()
    {
        $this->assertEquals(50, $this->class->getAge());
    }

    //... No need to test setters anf getters
}