<?php

namespace JK\Bittrex;


/**
 * Class PublicApi
 * @package JK\Bittrex
 */
class PublicApi extends BaseApi
{

    /**
     * The API name
     */
    CONST NAME = 'public';

    /**
     * PublicApi constructor.
     */
    public function __construct()
    {
        parent::__construct(self::NAME);
    }

    /**
     * @return array|mixed
     */
    public function getCurrencies()
    {
        return parent::send('getcurrencies');
    }

    /**
     * @return array|mixed
     */
    public function getMarkets()
    {
        return parent::send('getmarkets');
    }

    /**
     * @param $currencyPair
     * @param string $type
     * @return array|mixed
     * @throws \Exception
     * TODO create custom Exception class and look at how this might get handled
     */
    public function getOrderBook($currencyPair, $type = 'both')
    {
        if(!in_array($type, ['buy', 'sell', 'both'])) {
            throw new \Exception('Invalid type supplied');
        }

        return parent::send('getorderbook', [
            'market' => $currencyPair,
            'type' => $type
        ]);
    }

    /**
     * @param $currencyPair
     * @return array|mixed
     */
    public function getMarketHistory($currencyPair)
    {
        return parent::send('getmarkethistory', [
            'market' => $currencyPair
        ]);
    }

    /**
     * @param $currencyPair
     * @return array|mixed
     */
    public function getMarketSummary($currencyPair)
    {
        return parent::send('getmarketsummary', [
            'market' => $currencyPair
        ]);
    }

    /**
     * @return array|mixed
     */
    public function getMarketSummaries()
    {
        return parent::send('getmarketsummaries');
    }

    /**
     * @param null $currencyPair
     * @return array|mixed
     */
    public function getTicker($currencyPair = NULL)
    {
        return parent::send('getticker', [
            'market' => $currencyPair
        ]);
    }

}