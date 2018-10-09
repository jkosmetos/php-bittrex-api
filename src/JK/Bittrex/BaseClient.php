<?php

namespace JK\Bittrex;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

/**
 * Class BaseClient.
 */
abstract class BaseClient
{
    /**
     * Base API URL.
     */
    const BASE_URL = 'https://bittrex.com/api/';

    /**
     * Current API Version.
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
    protected $key;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @var string
     */
    protected $nonce;

    /**
     * BaseClient constructor.
     *
     * @param string $group
     * @param null   $key
     * @param null   $secret
     */
    public function __construct($key = null, $secret = null)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->nonce = self::getNonce();
        $this->baseUrl = self::getBaseUrl();
        $this->client = new Client();
    }

    /**
     * @param null $group
     *
     * @return string
     */
    protected static function getBaseUrl()
    {
        return self::BASE_URL.self::VERSION;
    }

    /**
     * @param int $min
     * @param int $max
     *
     * @return int
     */
    protected static function getNonce($min = 5, $max = 32)
    {
        return random_int($min, $max);
    }

    /**
     * @param $uri
     * @param $secret
     *
     * @return string
     */
    protected static function sign($uri, $secret)
    {
        return hash_hmac('sha512', $uri, $secret);
    }

    /**
     * @param $action
     * @param array $params
     * @param bool  $sign
     *
     * @return array|mixed
     */
    protected function send($action, $params = [], $sign = false)
    {
        try {
            $options = [];
            $query = http_build_query(array_filter($params));
            $uri = ($this->baseUrl.$action.($query ? "?{$query}" : ''));

            if ($sign) {
                $options['headers'] = [
                    'apisign' => self::sign($uri, $this->secret),
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
     *
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
     * @param bool     $assoc
     *
     * @return mixed
     */
    protected function parseResponse(Response $response, $assoc = true)
    {
        return json_decode($response->getBody(), $assoc);
    }
}
