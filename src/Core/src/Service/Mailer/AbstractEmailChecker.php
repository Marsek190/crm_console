<?php
declare(strict_types=1);

namespace Core\Service\Mailer;


abstract class AbstractEmailChecker
{
    protected string $email;

    protected string $favoriteEmailRegex;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public abstract function check(): bool;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

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