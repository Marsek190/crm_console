<?php
declare(strict_types=1);

namespace Core\Entity\DTO;


class Order
{
    protected int $id;

    protected float $priceWithDiscount;

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
     * @return float
     */
    public function getPriceWithDiscount(): float
    {
        return $this->priceWithDiscount;
    }

    /**
     * @param float $priceWithDiscount
     * @return Order
     */
    public function setPriceWithDiscount(float $priceWithDiscount): Order
    {
        $this->priceWithDiscount = $priceWithDiscount;
        return $this;
    }
}