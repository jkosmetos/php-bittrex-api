<?php

namespace JK\Bittrex;


/**
 * Class AccountApi
 * @package JK\Bittrex
 */
class AccountApi extends BaseApi
{

    /**
     * The API name
     */
    const NAME = 'account';

    /**
     * AccountApi constructor.
     * @param string $key
     * @param null $secret
     */
    public function __construct($key, $secret)
    {
        parent::__construct(self::NAME, $key, $secret);
    }

    /**
     * @return mixed
     */
    public function getBalances()
    {
        return parent::send('getbalances', [
            'apikey' => $this->key,
            'nonce' => $this->nonce
        ], true);
    }

    /**
     * @param $currency
     * @return mixed
     */
    public function getBalance($currency)
    {
        return parent::send('getbalance', [
            'apikey' => $this->key,
            'nonce' => $this->nonce,
            'currency' => $currency
        ]);
    }

    /**
     * @param $currency
     * @return mixed
     */
    public function getDepositAddress($currency)
    {
        return parent::send('getdepositaddress', [
            'apikey' => $this->key,
            'nonce' => $this->nonce,
            'currency' => $currency
        ], true);
    }

    /**
     * @param $currency
     * @param $quantity
     * @param $address
     * @param null $paymentId
     * @return mixed
     */
    public function withdraw($currency, $quantity, $address, $paymentId = null)
    {
        return parent::send('withdraw', [
            'apikey' => $this->key,
            'nonce' => $this->nonce,
            'currency' => $currency,
            'quantity' => $quantity,
            'address' => $address,
            'paymentid' => $paymentId
        ], true);
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function getOrder($uuid)
    {
        return parent::send('getorder', [
            'apikey' => $this->key,
            'nonce' => $this->nonce,
            'uuid' => $uuid
        ], true);
    }

    /**
     * @param null $market
     * @return array|mixed
     */
    public function getOrderHistory($market = null)
    {
        return parent::send('getorderhistory', [
            'apikey' => $this->key,
            'nonce' => $this->nonce,
            'market' => $market
        ], true);
    }

    /**
     * @param null $currency
     * @return array|mixed
     */
    public function getWithdrawalHistory($currency = null)
    {
        return parent::send('getwithdrawalhistory', [
            'apikey' => $this->key,
            'nonce' => $this->nonce,
            'currency' => $currency
        ], true);
    }

    /**
     * @param null $currency
     * @return array|mixed
     */
    public function getDepositHistory($currency = null)
    {
        return parent::send('getdeposithistory', [
            'apikey' => $this->key,
            'nonce' => $this->nonce,
            'currency' => $currency
        ], true);
    }

}