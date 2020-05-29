<?php
declare(strict_types=1);

namespace Core\Entity\DTO;


class AmountPriceToDiscount
{
    protected float $priceWithDiscount;

    protected float $discountValue;

    /**
     * @return float
     */
    public function getPriceWithDiscount(): float
    {
        return $this->priceWithDiscount;
    }

    /**
     * @param float $priceWithDiscount
     * @return AmountPriceToDiscount
     */
    public function setPriceWithDiscount(float $priceWithDiscount): AmountPriceToDiscount
    {
        $this->priceWithDiscount = $priceWithDiscount;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountValue(): float
    {
        return $this->discountValue;
    }

    /**
     * @param float $discountValue
     * @return AmountPriceToDiscount
     */
    public function setDiscountValue(float $discountValue): AmountPriceToDiscount
    {
        $this->discountValue = $discountValue;
        return $this;
    }
}