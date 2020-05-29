<?php
declare(strict_types=1);

namespace Core\Entity;


use App\BaseInterface\ConvertToArrayInterface;
use App\BaseInterface\GetAllPropsInterface;
use App\Entity\GetAllPropsTrait;
use App\Entity\ToArrayTrait;

abstract class AbstractRootEntity implements GetAllPropsInterface, ConvertToArrayInterface
{
    use GetAllPropsTrait;
    use ToArrayTrait;

    /**
     * @return mixed
     */
    public abstract function getId();
}