<?php

namespace JK\Bittrex;


/**
 * Class MarketApi
 * @package JK\Bittrex
 */
class MarketApi extends BaseApi
{

    /**
     * The API name
     */
    const NAME = 'market';

    /**
     * MarketApi constructor.
     * @param string $apiKey
     * @param null $apiSecret
     */
    public function __construct($apiKey, $apiSecret)
    {
        parent::__construct(self::NAME, $apiKey, $apiSecret);
    }

    /**
     * @param $market
     * @param $quantity
     * @param $rate
     * @return mixed
     */
    public function buyLimit($market, $quantity, $rate)
    {
        return parent::send('buylimit', [
            'apikey' => $this->apiKey,
            'nonce' => $this->nonce,
            'market' => $market,
            'quantity' => $quantity,
            'rate' => $rate
        ], true);
    }

    /**
     * @param $market
     * @param $quantity
     * @param $rate
     * @return mixed
     */
    public function sellLimit($market, $quantity, $rate)
    {
        return parent::send('selllimit', [
            'apikey' => $this->apiKey,
            'nonce' => $this->nonce,
            'market' => $market,
            'quantity' => $quantity,
            'rate' => $rate
        ], true);
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function cancel($uuid)
    {
        return parent::send('cancel', [
            'apikey' => $this->apiKey,
            'nonce' => $this->nonce,
            'uuid' => $uuid
        ], true);
    }

    /**
     * @param null $market
     * @return mixed
     */
    public function getOpenOrders($market = null)
    {
        return parent::send('getopenorders', [
            'apikey' => $this->apiKey,
            'nonce' => $this->nonce,
            'market' => $market
        ], true);
    }
}