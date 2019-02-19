<?php
namespace Core\Base;

/**
 * Class SalariedTrait
 */
trait SalariedTrait
{
    /**
     * @var integer
     */
    protected $value = 0;

    /**
     * @var integer
     */
    protected $percentage = 0;

    /**
     * @var integer
     */
    protected $fixed = 0;

    /**
     * @var bool
     */
    protected $isFixed = false;

    /**
     * SalariedTrait constructor.
     *
     * @param int $value
     */
    public function __construct($value = 0)
    {
        $this->value = $value;

        $this->handle();
    }

    /**
     * Value getter.
     *
     * @param string $type
     *
     * @return mixed
     */
    public function getValue($type = 'percentage')
    {
        if ($this->isFixed) {
            return $this->fixed;
        }

        return $this->percentage;
    }

    /**
     * Is Fixed Price setter.
     *
     * @param bool $value
     *
     * @return $this
     */
    public function setIsFixedPrice(bool $value)
    {
        $this->isFixed = $value;

        return $this;
    }

    /**
     * Is Fixed Price getter.
     *
     * @return bool
     */
    public function getIsFixedPrice(): bool
    {
        return $this->isFixed;
    }
}