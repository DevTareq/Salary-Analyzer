<?php
namespace Core\Analyzers;

use Core\Base\SalariedTrait;
use Core\Contracts\SalariedInterface;

/**
 * Class KidsAnalyzer.
 *
 * @property integer value
 * @property integer percentage
 * @property integer fixed
 */
class KidsAnalyzer implements SalariedInterface
{
    use SalariedTrait;

    /**
     * Handle Calculations.
     */
    public function handle()
    {
        $this->percentage = 0;
        $this->fixed      = 0;
    }
}
