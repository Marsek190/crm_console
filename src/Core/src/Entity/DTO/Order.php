<?php
declare(strict_types=1);

namespace Core\Entity\DTO;


class Order
{
    protected int $id;

    protected AmountPriceToDiscount $amountPriceToDiscount;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Order
     */
    public function setId(int $id): Order
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return AmountPriceToDiscount
     */
    public function getAmountPriceToDiscount(): AmountPriceToDiscount
    {
        return $this->amountPriceToDiscount;
    }

    /**
     * @param AmountPriceToDiscount $amountPriceToDiscount
     * @return Order
     */
    public function setAmountPriceToDiscount(AmountPriceToDiscount $amountPriceToDiscount): Order
    {
        $this->amountPriceToDiscount = $amountPriceToDiscount;
        return $this;
    }
}