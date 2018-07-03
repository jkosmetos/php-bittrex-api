<?php

namespace JK\Bittrex;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

/**
 * Class BaseApi
 * @package JK\Bittrex
 */
abstract class BaseApi
{

    /**
     * Base API URL
     */
    const BASE_URL = 'https://bittrex.com/api/';

    /**
     * Current API Version
     */
    const VERSION = 'v1.1';

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $apiSecret;

    /**
     * @var string
     */
    protected $nonce;

    /**
     * BaseApi constructor.
     * @param string $group
     * @param null $apiKey
     * @param null $apiSecret
     */
    public function __construct($group = PublicApi::NAME, $apiKey = null, $apiSecret = null)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->nonce = self::getNonce();
        $this->baseUrl = self::getBaseUrl($group);
        $this->client = new Client([
            'base_uri' => $this->baseUrl
        ]);
    }

    /**
     * @return string
     */
    protected static function getBaseUrl($group = null)
    {
        return (self::BASE_URL . self::VERSION . ($group ? "/{$group}/" : ''));
    }

    /**
     * @return string
     */
    protected static function getNonce($length = 32)
    {
        return random_bytes($length);
    }

    /**
     * @param $uri
     * @param $secret
     * @return string
     */
    protected static function sign($uri, $secret)
    {
        return hash_hmac('sha512', $uri, $secret);
    }

    /**
     * @param $action
     * @param array $params
     * @param bool $sign
     * @return array|mixed
     */
    protected function send($action, $params = [], $sign = false)
    {
        try {

            $options = [];
            $query = http_build_query(array_filter($params));
            $uri = ($this->baseUrl . $action . ($query ? "?{$query}" : ''));

            if($sign) {

                $options['headers'] = [
                    'apisign' => self::sign($uri, $this->apiSecret)
                ];

            }

            $response = $this->client->request('GET', $uri, $options);

            return self::parseResponse($response);

        } catch (RequestException $e) {

            return self::parseException($e);

        }
    }

    /**
     * @param RequestException $e
     * @return array
     */
    protected function parseException(RequestException $e)
    {
        $payload = ['message' => $e->getMessage(), 'code' => $e->getCode()];

        if ($e->hasResponse()) {

            $payload['message'] = $e->getResponse()->getReasonPhrase();

        }

        return $payload;
    }

    /**
     * @param Response $response
     * @param bool $assoc
     * @return mixed
     */
    protected function parseResponse(Response $response, $assoc = true)
    {
        return json_decode($response->getBody(), $assoc);
    }


}