<?php
declare(strict_types=1);

namespace Core\Service\Discount;



use Core\Entity\DTO\AmountPriceToDiscount;
use Core\Entity\Order;
use SebastianBergmann\Money\Currency;
use SebastianBergmann\Money\Money;

class Context implements CurrencyIsoConverterInterface
{
    protected array $strategies;

    protected Order $order;

    public function __construct(array $strategies = [])
    {
        $this->strategies = $strategies;
    }

    /**
     * @param Order $order
     * @return Context
     */
    public function setOrder(Order $order): Context
    {
        $this->order = $order;
        return $this;
    }

    public function execute(): AmountPriceToDiscount
    {
        $amountPriceToDiscountDto = new AmountPriceToDiscount();
        if (empty($this->strategies)) {
            return $amountPriceToDiscountDto
                ->setPriceWithDiscount($this->order->getTotalPrice())
                ->setDiscountValue(0);
        }

        $currencyConverter = $this->convert();

        $amountDiscount = 0;
        $c = new Currency($currencyConverter[$this->order->getCountryIso()]);
        $m = Money::fromString((string) $this->order->getTotalPrice(), $c);

        /**
         * @var $strategy DiscountStrategyInterface|CurrencyInterface
         */
        foreach ($this->strategies as $strategy) {
            $amountDiscount += $strategy->setMoney($m)->execute();
        }

        return $amountPriceToDiscountDto
            ->setPriceWithDiscount($m->subtract(Money::fromString((string) $amountDiscount, $c))->getConvertedAmount())
            ->setDiscountValue($amountDiscount);
    }

    public function convert(): array
    {
        return [
            'RU' => 'RUB',
        ];
    }
}