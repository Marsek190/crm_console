<?php
declare(strict_types=1);

namespace Core\Exception;


final class OrderNotFoundException extends \Exception
{
    const MESSAGE = '';

    public function __construct(string $message = self::MESSAGE)
    {
        parent::__construct($message, 0, null);
    }
}