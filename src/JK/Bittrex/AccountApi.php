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
     * @param string $apiKey
     * @param null $apiSecret
     */
    public function __construct($apiKey, $apiSecret)
    {
        parent::__construct(self::NAME, $apiKey, $apiSecret);
    }

    /**
     * @return mixed
     */
    public function getBalances()
    {
        return parent::send('getbalances', [
            'apikey' => $this->apiKey,
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
            'apikey' => $this->apiKey,
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
            'apikey' => $this->apiKey,
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
            'apikey' => $this->apiKey,
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
            'apikey' => $this->apiKey,
            'nonce' => $this->nonce,
            'uuid' => $uuid
        ], true);
    }

    /**
     * @param null $market
     * @return mixed
     */
    public function getOrderHistory($market = null)
    {
        return parent::send('getorderhistory', [
            'apikey' => $this->apiKey,
            'nonce' => $this->nonce,
            'market' => $market
        ], true);
    }

    /**
     * @param null $currency
     * @return mixed
     */
    public function getWithdrawalHistory($currency = null)
    {
        return parent::send('getwithdrawalhistory', [
            'apikey' => $this->apiKey,
            'nonce' => $this->nonce,
            'currency' => $currency
        ], true);
    }

    /**
     * @param null $currency
     * @return mixed
     */
    public function getDepositHistory($currency = null)
    {
        return parent::send('getdeposithistory', [
            'apikey' => $this->apiKey,
            'nonce' => $this->nonce,
            'currency' => $currency
        ], true);
    }

}