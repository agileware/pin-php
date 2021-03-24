<?php

declare(strict_types=1);

namespace Pin;

use GuzzleHttp\Client as HttpClient;
use Pin\Request\Base;

/**
 * Pin handler class.
 *
 *  Provides methods to initialize and submit a request to the Pin API server.
 *
 * @package Pin
 */
class Handler
{
    /**
     * Pin API configuration.
     *
     * @var \Pin\Configuration
     */
    private $config;

    /**
     * The request object.
     *
     * @var \Pin\Request\Base
     */
    private $request;

    /**
     * Constructor
     *
     * @param \Pin\Configuration $config
     *   Pin API configuration settings.
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * Sets the request instance.
     *
     * @param \Pin\Request\Base $request
     *   A request instance.
     */
    public function setRequest(Base $request)
    {
        $this->request = $request;
        $this->request->setConfig($this->config);

        $client = new HttpClient([
            'base_uri' => $this->config->host(),
            'timeout' => $this->config->timeout(),
            'allow_redirects' => false,
        ]);

        $this->request->setHttpClient($client);
    }

    /**
     * Instantiates a request class and sets it as the request instance.
     *
     * @param string $class
     *   The fully-qualified class name (i.e. Pin\Charge\Details::class).
     * @param mixed ...$parameters
     *   Optional parameters for the class constructor.
     */
    public function createRequest(string $class, ...$parameters)
    {
        $request = new $class(...$parameters);
        $this->setRequest($request);
    }

    /**
     * Gets the request instance.
     *
     * @return \Pin\Request\Base
     */
    public function getRequest(): Base
    {
        return $this->request;
    }

    /**
     * Submit a request to the Pin API server and returns its response.
     *
     * @return object
     *   The JSON response body converted into an object.
     *
     * @throws \GuzzleHttp\Exception\RequestException
     */
    public function submit(): object
    {
        return $this->request->submit();
    }
}
