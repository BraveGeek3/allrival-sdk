<?php

namespace AllrivalSDK\Types;

use AllrivalSDK\Tools\Converter;

class PriceHistoryType implements TypeInterface
{
    private array $history;

    /**
     * Возвращает массив с историей цен
     *
     * @return array
     */
    public function getHistory(): array
    {
        return $this->history;
    }

    public function setHistory(array $history): self
    {
        $this->history = $history;

        return $this;
    }

    /**
     * @param $date
     * @return float|null
     * @throws \AllrivalSDK\Exceptions\InvalidArgumentException
     */
    public function getByDate($date): ?float
    {
        if (is_int($date)) {
            return $this->history[$date] ?? null;
        }

        $timestamp = Converter::convertDateToTmstmp($date);

        return $this->history[$timestamp] ?? null;
    }
}