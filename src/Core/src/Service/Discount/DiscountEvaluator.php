<?php
declare(strict_types=1);

namespace Core\Service\Discount;


use Core\Entity\Order;
use Core\Service\Mailer\AbstractEmailChecker;

class DiscountEvaluator
{
    protected AbstractEmailChecker $emailChecker;

    protected Order $order;

    public function __construct(AbstractEmailChecker $emailChecker)
    {
        $this->emailChecker = $emailChecker;
    }

    /**
     * @param Order $order
     * @return DiscountEvaluator
     */
    public function setOrder(Order $order): DiscountEvaluator
    {
        $this->order = $order;
        return $this;
    }

    public function getPriceWithDiscount(): float
    {
        $discountStrategies = [];
        if ($this->isFavoriteEmail($this->order->getEmail())) {
            $discountStrategies[] = new FavoriteEmailStrategy();
        }

        return (new Context($discountStrategies))->setOrder($this->order)->execute();
    }

    protected function isFavoriteEmail(?string $email): bool
    {
        return ! is_null($email) && $this->emailChecker->setEmail($email)->check();
    }
}