<?php

namespace JK\Bittrex;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * @return array|mixed
     */
    public function getCurrencies()
    {
        return parent::send('/public/getcurrencies');
    }

    /**
     * @return array|mixed
     */
    public function getMarkets()
    {
        return parent::send('/public/getmarkets');
    }

    /**
     * @param $currencyPair
     * @param string $type
     *
     * @throws \Exception
     *
     * @return array|mixed
     */
    public function getOrderBook($currencyPair, $type = 'both')
    {
        if (!in_array($type, ['buy', 'sell', 'both'])) {
            throw new \Exception('Invalid type supplied');
        }

        return parent::send('/public/getorderbook', [
            'market' => $currencyPair,
            'type'   => $type,
        ]);
    }

    /**
     * @param $currencyPair
     *
     * @return array|mixed
     */
    public function getMarketHistory($currencyPair)
    {
        return parent::send('/public/getmarkethistory', [
            'market' => $currencyPair,
        ]);
    }

    /**
     * @param $currencyPair
     *
     * @return array|mixed
     */
    public function getMarketSummary($currencyPair)
    {
        return parent::send('/public/getmarketsummary', [
            'market' => $currencyPair,
        ]);
    }

    /**
     * @return array|mixed
     */
    public function getMarketSummaries()
    {
        return parent::send('/public/getmarketsummaries');
    }

    /**
     * @param null $currencyPair
     *
     * @return array|mixed
     */
    public function getTicker($currencyPair = null)
    {
        return parent::send('/public/getticker', [
            'market' => $currencyPair,
        ]);
    }

    /**
     * @return mixed
     */
    public function getBalances()
    {
        return parent::send('/account/getbalances', [
            'apikey' => $this->key,
            'nonce'  => $this->nonce,
        ], true);
    }

    /**
     * @param $currency
     *
     * @return mixed
     */
    public function getBalance($currency)
    {
        return parent::send('/account/getbalance', [
            'apikey'   => $this->key,
            'nonce'    => $this->nonce,
            'currency' => $currency,
        ]);
    }

    /**
     * @param $currency
     *
     * @return mixed
     */
    public function getDepositAddress($currency)
    {
        return parent::send('/account/getdepositaddress', [
            'apikey'   => $this->key,
            'nonce'    => $this->nonce,
            'currency' => $currency,
        ], true);
    }

    /**
     * @param $currency
     * @param $quantity
     * @param $address
     * @param null $paymentId
     *
     * @return mixed
     */
    public function withdraw($currency, $quantity, $address, $paymentId = null)
    {
        return parent::send('/account/withdraw', [
            'apikey'    => $this->key,
            'nonce'     => $this->nonce,
            'currency'  => $currency,
            'quantity'  => $quantity,
            'address'   => $address,
            'paymentid' => $paymentId,
        ], true);
    }

    /**
     * @param $uuid
     *
     * @return mixed
     */
    public function getOrder($uuid)
    {
        return parent::send('/account/getorder', [
            'apikey' => $this->key,
            'nonce'  => $this->nonce,
            'uuid'   => $uuid,
        ], true);
    }

    /**
     * @param null $market
     *
     * @return array|mixed
     */
    public function getOrderHistory($market = null)
    {
        return parent::send('/account/getorderhistory', [
            'apikey' => $this->key,
            'nonce'  => $this->nonce,
            'market' => $market,
        ], true);
    }

    /**
     * @param null $currency
     *
     * @return array|mixed
     */
    public function getWithdrawalHistory($currency = null)
    {
        return parent::send('/account/getwithdrawalhistory', [
            'apikey'   => $this->key,
            'nonce'    => $this->nonce,
            'currency' => $currency,
        ], true);
    }

    /**
     * @param null $currency
     *
     * @return array|mixed
     */
    public function getDepositHistory($currency = null)
    {
        return parent::send('/account/getdeposithistory', [
            'apikey'   => $this->key,
            'nonce'    => $this->nonce,
            'currency' => $currency,
        ], true);
    }

    /**
     * @param $market
     * @param $quantity
     * @param $rate
     *
     * @return mixed
     */
    public function buyLimit($market, $quantity, $rate)
    {
        return parent::send('/market/buylimit', [
            'apikey'   => $this->key,
            'nonce'    => $this->nonce,
            'market'   => $market,
            'quantity' => $quantity,
            'rate'     => $rate,
        ], true);
    }

    /**
     * @param $market
     * @param $quantity
     * @param $rate
     *
     * @return mixed
     */
    public function sellLimit($market, $quantity, $rate)
    {
        return parent::send('/market/selllimit', [
            'apikey'   => $this->key,
            'nonce'    => $this->nonce,
            'market'   => $market,
            'quantity' => $quantity,
            'rate'     => $rate,
        ], true);
    }

    /**
     * @param $uuid
     *
     * @return mixed
     */
    public function cancel($uuid)
    {
        return parent::send('/market/cancel', [
            'apikey' => $this->key,
            'nonce'  => $this->nonce,
            'uuid'   => $uuid,
        ], true);
    }

    /**
     * @param null $market
     *
     * @return mixed
     */
    public function getOpenOrders($market = null)
    {
        return parent::send('/market/getopenorders', [
            'apikey' => $this->key,
            'nonce'  => $this->nonce,
            'market' => $market,
        ], true);
    }
}
