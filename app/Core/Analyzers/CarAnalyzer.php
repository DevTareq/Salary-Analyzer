<?php
namespace Core\Analyzers;

use Core\Base\SalariedTrait;
use Core\Contracts\SalariedInterface;

/**
 * Class CarAnalyzer.
 *
 * @property integer value
 * @property integer percentage
 * @property integer fixed
 */
class CarAnalyzer implements SalariedInterface
{
    use SalariedTrait;

    /**
     * Handle Calculations.
     */
    public function handle()
    {
        $this->percentage = 0;
        $this->fixed      = 500;
    }
}