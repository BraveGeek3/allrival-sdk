<?php

namespace AllrivalSDK\Filters;

interface FilterInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     * @return void
     */
    public function setType(string $type): void;

    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @param string $value
     * @return void
     */
    public function setValue(string $value): void;

    /**
     * @return string
     */
    public function getStringQuery(): string;

    /**
     * @return array
     */
    public static function getAllowedTypeValues(): array;

}