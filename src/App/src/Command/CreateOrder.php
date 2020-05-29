<?php
declare(strict_types=1);

namespace App\Command;


use Core\Exception\OrderExistsError;
use Core\Exception\WrongOrderStoreException;
use Core\Service\Order;
use RetailCrm\ApiClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateOrder extends Command
{
    const ORDER_NUMBER_ARGUMENT = 'order';

    const COMMAND_ERROR_CODE = 1;

    protected static $defaultName = 'app:create-order';

    protected ApiClient $client;

    protected Order $order;

    public function __construct(ApiClient $client, Order $order)
    {
        parent::__construct();

        $this->client = $client;
        $this->order = $order;
    }

    protected function configure()
    {
        $this->addArgument(
            static::ORDER_NUMBER_ARGUMENT,
            InputArgument::REQUIRED,
            'The number of order.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $orderNumber = $input->getArgument(static::ORDER_NUMBER_ARGUMENT);
        $response = $this->client->request->ordersGet('74', 'id');
        if (! $response->isSuccessful()) {
            $output->write($response->asJsonResponse()->getResponseBody());

            return static::COMMAND_ERROR_CODE;
        }

        $orderUnprepared = $response['order'];
        $order = $this->createPreparedOrder($orderUnprepared);

        try {
            $orderDto = $this->order->save($order);
        } catch (OrderExistsError | WrongOrderStoreException $e) {
            $output->writeln($e->getMessage());

            return static::COMMAND_ERROR_CODE;
        }

        print_r($orderDto);
        $output->writeln('Order saved.');

        return 0;
    }

    protected function createPreparedOrder(array $orderUnprepared): \Core\Entity\Order
    {
        $order = (new \Core\Entity\Order())
            ->setId($orderUnprepared['id'])
            ->setCountryIso($orderUnprepared['countryIso'])
            ->setFirstName($orderUnprepared['firstName'])
            ->setLastName($orderUnprepared['lastName'])
            ->setOrderType($orderUnprepared['orderType'])
            ->setCreatedAt(new \DateTime($orderUnprepared['createdAt']))
            ->setTotalPrice($orderUnprepared['totalSumm'])
            ->setPriceWithDiscount($orderUnprepared['totalSumm']);
            //->setEmail('oliver-heldens@music.nd');

        if ($orderUnprepared['markDatetime']) {
            $order->setMarkDatetime(new \DateTime($orderUnprepared['markDatetime']));
        }

        if ($orderUnprepared['statusUpdatedAt']) {
            $order->setUpdatedAt(new \DateTime($orderUnprepared['statusUpdatedAt']));
        }

        return $order;
    }
}