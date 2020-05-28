<?php
declare(strict_types=1);

namespace Core\Service;


use Core\Exception\OrderExistsError;
use Core\Exception\WrongOrderStoreException;

class Order
{
    protected \Core\Repository\Order $order;

    public function __construct(\Core\Repository\Order $order)
    {
        $this->order = $order;
    }

    /**
     * @param \Core\Entity\Order $order
     * @return \Core\Entity\DTO\Order|null
     * @throws OrderExistsError|WrongOrderStoreException
     */
    public function save(\Core\Entity\Order $order): ?\Core\Entity\DTO\Order
    {
        if (! is_null($this->order->getById($order->getId()))) {
            throw new OrderExistsError();
        }

        $orderDto = $this->order->save($order);
        if (is_null($orderDto)) {
            throw new WrongOrderStoreException();
        }
        return $orderDto;
    }
}