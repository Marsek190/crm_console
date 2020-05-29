<?php
declare(strict_types=1);

namespace Core\Service\Discount;


use SebastianBergmann\Money\Money;

interface CurrencyInterface
{
    public function setMoney(Money $money): self;
}