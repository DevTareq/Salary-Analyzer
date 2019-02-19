<?php

namespace Core\Contracts;

/**
 * Interface SalariedInterface
 */
interface SalariedInterface
{
    /**
     * Handle Calculations.
     *
     * @return mixed
     */
    public function handle();

    /**
     * @return mixed
     */
    public function getValue();
}