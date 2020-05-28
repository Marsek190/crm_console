<?php
declare(strict_types=1);

namespace Core\Service\Mailer;


final class EmailChecker extends AbstractEmailChecker
{
    protected string $favoriteEmailRegex = '/oliver/';

    public function __construct(string $email)
    {
        parent::__construct($email);
    }

    public function check(): bool
    {
        return preg_match($this->favoriteEmailRegex, $this->email);
    }
}