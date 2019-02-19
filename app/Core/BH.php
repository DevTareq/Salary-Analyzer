<?php
namespace Core;

use Core\Base\TaxableCountry;
use Core\Contracts\CountryInterface;

/**
 * Class UAE
 */
class BH extends TaxableCountry implements CountryInterface
{
    /**
     * @var string $name
     */
    protected $name = 'Kingdom of Bahrain';

    /** @var string  */
    protected $currency = 'BHD';

    /**
     * @var int $tax
     */
    protected $tax = 10;

    /**
     * @var int $kidsAllowance
     */
    protected $kidsAllowance = 2;

    /**
     * @var int $distanceAllowance
     */
    protected $distanceAllowance = 4;

    /**
     * Calculate tax.
     *
     * @return int
     */
    public function calculateTax(): int
    {
        $this->kidsAllowance();

        /** $this->distanceAllowance(); --  add in case of distance allowance */

        return $this->getTax();
    }
}
