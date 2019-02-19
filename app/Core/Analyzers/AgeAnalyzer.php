<?php
namespace Core\Analyzers;

use Core\Base\SalariedTrait;
use Core\Contracts\SalariedInterface;

/**
 * Class AgeAnalyzer.
 *
 * @property integer value
 * @property integer percentage
 * @property integer fixed
 */
class AgeAnalyzer implements SalariedInterface
{
    use SalariedTrait;

    /**
     * Handle Calculations.
     */
    public function handle()
    {
        if ($this->value > 50) {
            $this->percentage = 7;
            $this->fixed      = 0;
        }
    }
}