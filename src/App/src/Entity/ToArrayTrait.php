<?php
declare(strict_types=1);

namespace App\Entity;


trait ToArrayTrait
{
    protected array $needFields = [];

    protected array $convertFieldsAliasesMap = [];

    /**
     * @param bool $dateFormat
     * @return array
     */
    public function toArray($dateFormat = false): array
    {
        $result = $this->getAllProps();
        $entityToArray = [];

        foreach ($result as $prop => $value) {
            if (! in_array($prop, $this->needFields)) {
                continue;
            }

            if ($value instanceof \DateTime) {
                if ($dateFormat) {
                    /**
                     * @var \DateTime $value
                     */
                    $entityToArray[$prop] = $value->format($dateFormat);
                } else {
                    /**
                     * @var \DateTime $value
                     */
                    $entityToArray[$prop] = $value->getTimestamp();
                }
            }
            $entityToArray[$prop] = $value;
        }

        return $entityToArray;
    }
}