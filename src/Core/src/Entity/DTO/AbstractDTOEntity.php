<?php
declare(strict_types=1);

namespace Core\Entity\DTO;


use App\BaseInterface\ConvertToArrayInterface;
use App\BaseInterface\GetAllPropsInterface;
use App\Entity\GetAllPropsTrait;
use App\Entity\ToArrayTrait;

abstract class AbstractDTOEntity implements GetAllPropsInterface, ConvertToArrayInterface
{
	use GetAllPropsTrait;
    use ToArrayTrait;
}