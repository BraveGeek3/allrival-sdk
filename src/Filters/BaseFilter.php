<?php

namespace AllrivalSDK\Filters;

use ReflectionClass;

abstract class BaseFilter implements FilterInterface
{
    protected string $name;
    protected string $type;
    protected string $value;

    public function __construct(string $value, string $type = '')
    {
        $this->setValue($value);
        $this->setType($type);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * Возвращает строковое представление фильтра для GET-запроса
     *
     * @return string
     */
    public function getStringQuery(): string
    {
        return "filter[" . $this->getName() . "][type]=" . $this->type . '&' . "filter[" . $this->getName() . "][value]=" . urlencode($this->value);
    }

    /**
     * Возвращает возможные значения типов для данного фильтра
     *
     * @return array
     */
    public static function getAllowedTypeValues(): array
    {
        return (new ReflectionClass(static::class))->getConstants();
    }
}
