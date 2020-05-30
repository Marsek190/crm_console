<?php
declare(strict_types=1);

namespace Core\Entity\DTO;


class Order extends AbstractDTOEntity
{
    protected int $id;
    
    protected float $priceWithDiscount;
    
    protected float $personalDiscount = 0;

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

    /**
     * @return float|int
     */
    public function getPersonalDiscount()
    {
        return $this->personalDiscount;
    }

    /**
     * @param float|int $personalDiscount
     * @return Order
     */
    public function setPersonalDiscount($personalDiscount)
    {
        $this->personalDiscount = $personalDiscount;
        return $this;
    }
}