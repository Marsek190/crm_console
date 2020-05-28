<?php
declare(strict_types=1);

namespace Core\Entity\Response;


use Symfony\Component\HttpFoundation\JsonResponse;

final class Fail extends JsonResponse
{
    private function __construct(array $data = [], $status = self::HTTP_BAD_REQUEST)
    {
        parent::__construct($data, $status);
    }

    public static function fromArrayMessages(array $messages, $status = self::HTTP_BAD_REQUEST): Fail
    {
        return new static(compact('messages'), $status);
    }

    public static function fromStringMessage(string $message, $status = self::HTTP_BAD_REQUEST): Fail
    {
        return new static(compact('message'), $status);
    }
}