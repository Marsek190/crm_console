<?php
declare(strict_types=1);

namespace Core\Service\Discount;


interface CurrencyIsoConverterInterface
{
    public function convert(): array;
}