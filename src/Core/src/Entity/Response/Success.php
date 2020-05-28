<?php
declare(strict_types=1);

namespace Core\Entity\Response;


use Symfony\Component\HttpFoundation\JsonResponse;

final class Success extends JsonResponse
{
    public function __construct(array $data = [])
    {
        parent::__construct(array_merge($data, ['status' => 'ok']));
    }
}