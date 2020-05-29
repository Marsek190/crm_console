<?php
declare(strict_types=1);

namespace Core\Service\Mailer;


abstract class AbstractEmailChecker
{
    protected string $email;

    protected string $favoriteEmailRegex;

    public abstract function check(): bool;

    /**
     * @param string $email
     * @return AbstractEmailChecker
     */
    public function setEmail(string $email): AbstractEmailChecker
    {
        $this->email = $email;
        return $this;
    }
}