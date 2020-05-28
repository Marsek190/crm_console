<?php
declare(strict_types=1);

namespace Core\Entity;


abstract class AbstractRootEntity
{
    /**
     * @return mixed
     */
    public abstract function getId();
}