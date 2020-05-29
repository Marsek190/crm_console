<?php
declare(strict_types=1);

namespace Core\Service\Discount;


use SebastianBergmann\Money\Money;

final class FavoriteEmailStrategy implements DiscountStrategyInterface, CurrencyInterface
{
    const DISCOUNT_VALUE_IN_PERCENT = 10;

    private Money $money;

    /**
     * @param Money $money
     * @return FavoriteEmailStrategy
     */
    public function setMoney(Money $money): FavoriteEmailStrategy
    {
        $this->money = $money;
        return $this;
    }

    public function execute(): float
    {
        $extract = $this->money->extractPercentage(static::DISCOUNT_VALUE_IN_PERCENT);

        return $extract['percentage']->getConvertedAmount();
    }
}