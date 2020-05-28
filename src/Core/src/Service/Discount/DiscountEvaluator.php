<?php
declare(strict_types=1);

namespace Core\Service\Discount;


use Core\Entity\Order;
use Core\Service\Mailer\AbstractEmailChecker;

class DiscountEvaluator
{
    protected AbstractEmailChecker $emailChecker;

    public function __construct(AbstractEmailChecker $emailChecker)
    {
        $this->emailChecker = $emailChecker;
    }

    public function getDiscount(Order $order): float
    {
        $discountStrategies = [];
        if ($this->isFavoriteEmail($order->getEmail())) {
            $discountStrategies[] = new FavoriteEmailStrategy();
        }

        return (new Context($discountStrategies))->execute();
    }

    protected function isFavoriteEmail(?string $email): bool
    {
        return ! is_null($email) && $this->emailChecker->setEmail($email)->check();
    }
}