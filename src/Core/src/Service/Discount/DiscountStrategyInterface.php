<?php
declare(strict_types=1);

namespace Core\Service\Discount;


interface DiscountStrategyInterface
{
    public function execute(): float;
}