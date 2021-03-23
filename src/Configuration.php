<?php

declare(strict_types=1);

namespace Pin;

/**
 * Pin configuration class.
 *
 * Provides standard properties and methods to connect to the Pin API.
 *
 * @package Pin
 */
class Configuration
{
    /**
     * The live Pin API host.
     *
     * @var string
     */
    public const API_LIVE_ENDPOINT = 'https://api.pinpayments.com/';

    /**
     * The test Pin API host.
     *
     * @var string
     */
    public const API_TEST_ENDPOINT = 'https://test-api.pinpayments.com/';

    /**
     * Pin API version.
     *
     * @var string
     */
    public const API_VERSION = '1';

    /**
     * The private key.
     *
     * @var string
     */
    private $secretKey;

    /**
     * The public key.
     *
     * @var string
     */
    private $publicKey;

    /**
     * The operating API host.
     *
     * @var string
     */
    private $host;

    /**
     * The operating API environment.
     *
     * @var string
     */
    private $environment;

    /**
     * The connection timeout in seconds.
     *
     * @var int
     */
    private $timeout;

    /**
     * Configuration constructor.
     *
     * @param string $secret_key
     *   The public key.
     * @param string $public_key
     *   The public key.
     * @param string $environment
     *   The operating API environment.
     * @param int $timeout
     *   The connection timeout in seconds.
     */
    public function __construct(string $secret_key, string $public_key, string $environment = 'test', int $timeout = 60)
    {
        $this->secretKey = $secret_key;
        $this->publicKey = $public_key;
        $this->environment = $environment;
        $this->host = $this->environment == 'live' ? self::API_LIVE_ENDPOINT : self::API_TEST_ENDPOINT;
        $this->timeout = $timeout;
    }

    /**
     * Gets the public key.
     *
     * @return string
     */
    public function secretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * Gets the operating API host.
     *
     * @return string
     */
    public function host(): string
    {
        return $this->host;
    }

    /**
     * Gets the API version suffix.
     *
     * @return string
     */
    public function apiVersion(): string
    {
        return static::API_VERSION;
    }

    /**
     * Gets the API environment.
     *
     * @return string
     */
    public function environment(): string
    {
        return $this->environment;
    }

    /**
     * Gets the connection timeout.
     *
     * @return int
     */
    public function timeout(): int
    {
        return $this->timeout;
    }

    /**
     * List of currencies supported by PinPayments.com
     *
     * @return array
     */
    public static function supportedCurrencies(): array
    {
        return [
            'AUD',
            'USD',
            'NZD',
            'SGD',
            'EUR',
            'GBP',
            'CAD',
            'HKD',
            'JPY',
        ];
    }
}
