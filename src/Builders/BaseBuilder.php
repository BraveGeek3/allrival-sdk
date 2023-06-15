<?php

namespace AllrivalSDK\Builders;

use AllrivalSDK\Types\TypeInterface;

/**
 * Класс для создания объектов указанных типов на основе входного массива
 */
abstract class BaseBuilder
{
    public function __construct()
    {
        $this->reset();
    }

    /**
     * Принимает массив данных и на основе него создает объект нужного типа
     *
     * @param array $data
     * @return TypeInterface
     */
    abstract public function build(array $data): TypeInterface;

    /**
     * Переинициализирует объект внутри билдера
     *
     * @return void
     */
    abstract protected function reset(): void;

}