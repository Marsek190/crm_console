<?php
declare(strict_types=1);

namespace Core\Service\Discount;


class Context implements DiscountStrategyInterface
{
    protected array $strategies;

    public function __construct(array $strategies = [])
    {
        $this->strategies = $strategies;
    }

    public function execute(): float
    {
        $amountDiscount = 0;
        /**
         * @var $strategy DiscountStrategyInterface
         */
        foreach ($this->strategies as $strategy) {
            $amountDiscount += $strategy->execute();
        }

        return $amountDiscount;
    }
}