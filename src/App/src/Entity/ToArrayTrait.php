<?php
declare(strict_types=1);

namespace App\Entity;


trait ToArrayTrait
{
    protected array $needFields = [];

    /**
     * @param bool $dateFormat
     * @return array
     */
    public function toArray($dateFormat = false): array
    {
        if (count($this->needFields)) {
            $result = array_filter($this->getAllProps(), function (array $field) {
                [$prop, ] = $field;
                return in_array($prop, $this->needFields);
            });
        } else {
            $result = $this->getAllProps();
        }

        foreach ($result as $prop => $value) {
            $propToSnakeCase = $this->transformPropertyToSnakeCase($prop);
            if ($value instanceof \DateTime) {
                if ($dateFormat) {
                    /**
                     * @var \DateTime $value
                     */
                    $result[$propToSnakeCase] = $value->format($dateFormat);
                } else {
                    /**
                     * @var \DateTime $value
                     */
                    $result[$propToSnakeCase] = $value->getTimestamp();
                }
            }
        }

        return $result;
    }

    protected function transformPropertyToSnakeCase(string $prop): string
    {
        return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $prop));
    }
}