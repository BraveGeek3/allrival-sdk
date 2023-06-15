<?php

namespace AllrivalSDK\Builders;

use AllrivalSDK\Types\PriceHistoryType;

class PriceHistoryBuilder extends BaseBuilder
{
    /**
     * @var PriceHistoryType
     */
    private PriceHistoryType $priceHistory;

    /**
     * @param array $data
     * @return PriceHistoryType
     */
    public function build(array $data): PriceHistoryType
    {
        $history = [];

        foreach ($data as $historyChunk) {
            $timestamp = strtotime($historyChunk['updated_at']);
            $history[$timestamp] = $historyChunk['price'] ;
        }

        $this->priceHistory->setHistory($history);

        $result = $this->priceHistory;
        $this->reset();

        return $result;
    }

    /**
     * @return void
     */
    protected function reset(): void
    {
        $this->priceHistory = new PriceHistoryType();
    }
}