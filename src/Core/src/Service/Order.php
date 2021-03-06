<?php
declare(strict_types=1);

namespace Core\Service;


use Core\Exception\OrderExistsError;
use Core\Exception\WrongOrderStoreException;
use Core\Exception\WrongOrderUpdateException;
use Core\Exception\OrderNotFoundException;
use Core\Service\Discount\DiscountEvaluator;
use RetailCrm\ApiClient;

class Order
{
    const FIND_BY_ID_TYPE = 'id';

    protected \Core\Repository\Order $order;

    protected DiscountEvaluator $evaluator;

    protected ApiClient $client;

    public function __construct(\Core\Repository\Order $order, DiscountEvaluator $evaluator, ApiClient $client)
    {
        $this->order = $order;
        $this->evaluator = $evaluator;
        $this->client = $client;
    }

    /**
     * @param \Core\Entity\Order $order
     * @return \Core\Entity\DTO\Order|null
     * @throws OrderExistsError
     * @throws WrongOrderStoreException
     * @throws WrongOrderUpdateException
     */
    public function save(\Core\Entity\Order $order): ?\Core\Entity\DTO\Order
    {
        if (! is_null($this->order->getById($order->getId()))) {
            throw new OrderExistsError();
        }

        $amountPriceToDiscountDto = $this->evaluator->setOrder($order)->getAmountPriceToDiscount();
        $saved = $this->order->save(
            $order
                ->setPriceWithDiscount($amountPriceToDiscountDto->getPriceWithDiscount())
                ->setPersonalDiscount($amountPriceToDiscountDto->getDiscountValue())
        );
        if (! $saved) {
            throw new WrongOrderStoreException();
        }
        $orderDto = (new \Core\Entity\DTO\Order())
            ->setId($order->getId())
            ->setPriceWithDiscount($amountPriceToDiscountDto->getPriceWithDiscount())
            ->setPersonalDiscount($amountPriceToDiscountDto->getDiscountValue());

        return $orderDto;
    }

    /**
     * @param \Core\Entity\DTO\Order $orderDto
     * @throws WrongOrderUpdateException
     */
    public function updateOrderDiscountInCrm(\Core\Entity\DTO\Order $orderDto): void
    {
        $orderDtoToArray = $orderDto->toArray();
        $response = $this->client->request->ordersEdit($orderDtoToArray, static::FIND_BY_ID_TYPE);
        if (! $response->isSuccessful()) {
            throw new WrongOrderUpdateException($response->getResponseBody());
        }
    }
	
    /**
     * @param string $orderId
     * @throws OrderNotFoundException
     */
    public function getOrderById(string $orderId): \RetailCrm\Response\ApiResponse
    {
        $response = $this->client->request->ordersGet($orderId, static::FIND_BY_ID_TYPE);
        if (! $response->isSuccessful()) {
            throw new OrderNotFoundException();
        }

        return $response;
    }
}
