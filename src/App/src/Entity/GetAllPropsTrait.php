<?php
declare(strict_types=1);

namespace App\Entity;


trait GetAllPropsTrait
{
    /**
     * @return array
     */
    public function getAllProps(): array
    {
        return get_object_vars($this);
    }
}