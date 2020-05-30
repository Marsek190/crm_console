<?php
declare(strict_types=1);

namespace App\Entity;


trait ToArrayTrait
{
    /**
     * @param bool $dateFormat
     * @return array
     */
    public function toArray($dateFormat = false) : array
    {
        $result = $this->getAllProps();

        foreach ($result as $prop => $value) {
            if ($value instanceof \DateTime) {
                if ($dateFormat) {
                    /**
                     * @var \DateTime $value
                     */
                    $result[$prop] = $value->format($dateFormat);
                } else {
                    /**
                     * @var \DateTime $value
                     */
                    $result[$prop] = $value->getTimestamp();
                }
            }
        }

        return $result;
    }
}