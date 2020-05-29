<?php
declare(strict_types=1);

namespace Core\Service;


use Core\Exception\OrderExistsError;
use Core\Exception\WrongOrderStoreException;
use Core\Service\Discount\DiscountEvaluator;

class Order
{
    protected \Core\Repository\Order $order;

    protected DiscountEvaluator $evaluator;

    public function __construct(\Core\Repository\Order $order, DiscountEvaluator $evaluator)
    {
        $this->order = $order;
        $this->evaluator = $evaluator;
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

        $priceWithDiscount = $this->evaluator->setOrder($order)->getPriceWithDiscount();
        $orderDto = $this->order->save($order->setPriceWithDiscount($priceWithDiscount));
        if (is_null($orderDto)) {
            throw new WrongOrderStoreException();
        }
        return $orderDto;
    }
}