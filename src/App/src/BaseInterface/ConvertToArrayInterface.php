<?php
declare(strict_types=1);

namespace App\BaseInterface;


interface ConvertToArrayInterface
{
    public function toArray($dateFormat = false): array;
}