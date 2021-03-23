<?php

declare(strict_types=1);

namespace Pin\Request;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Pin\Configuration;
use Psr\Http\Message\ResponseInterface;
use stdClass;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Request base class.
 *
 * @package Pin\Request
 */
abstract class Base extends Request
{
    /**
     * Pin API configuration.
     *
     * @var \Pin\Configuration
     */
    protected $config;

    /**
     * The HTTP client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * Options returned by OptionsResolver::resolve().
     *
     * @var array
     */
    protected $options = [];

    /**
     * Request base class constructor.
     *
     * @param array $options
     *   Options to be used in the request.
     */
    public function __construct(array $options = [])
    {
        // Initialize options.
        if (!empty($options)) {
            $resolver = new OptionsResolver();
            $this->setDefaultOptions($resolver);
            $this->options = $resolver->resolve($options);
            $this->validateOptions();
        }

        // Subclasses must implement METHOD and URI constants.
        parent::__construct(static::METHOD, static::URI);
    }

    /**
     * Initializes the HTTP client.
     *
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function setHttpClient(ClientInterface $client)
    {
        $this->httpClient = $client;
    }

    /**
     * Sets the Pin configuration object.
     *
     * @param \Pin\Configuration $config
     */
    public function setConfig(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * Submits the request to the Pin API server.
     *
     * @return object
     *   The JSON response body converted into an object.
     *
     * @throws \GuzzleHttp\Exception\RequestException
     */
    public function submit(): object
    {
        try {
            $response = $this->httpClient->request(
                $this->getMethod(),
                $this->getPath(),
                $this->getRequestData()
            );
        } catch (GuzzleException $e) {
            $response = $e->getResponse();
            $message = sprintf(
                'Error %s (%s): "%s %s" resulted in response: %s',
                $response->getStatusCode(),
                $response->getReasonPhrase(),
                $this->getMethod(),
                $this->getURL(),
                $response->getBody()
            );
            throw new RequestException($message, $this, $response);
        }

        return $this->parseResponse($response);
    }

    /**
     * Process the response object to generate output data.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return object
     *   The JSON response body converted into an object.
     *
     * @throws \GuzzleHttp\Exception\RequestException
     */
    public function parseResponse(ResponseInterface $response): object
    {
        $body = $response->getBody()->getContents();

        // Some API calls will return an empty body (like deletions). Check that
        // before trying to decode it and (possibly) throw out an error.
        if (!empty($body)) {
            $data = json_decode($body);

            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                    $json_error = '';
                    break;
                case JSON_ERROR_DEPTH:
                    $json_error = 'The maximum stack depth has been exceeded';
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    $json_error = 'Invalid or malformed JSON';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    $json_error = 'Control character error, possibly incorrectly encoded';
                    break;
                case JSON_ERROR_SYNTAX:
                    $json_error = 'Syntax error';
                    break;
                case JSON_ERROR_UTF8:
                    $json_error = 'Malformed UTF-8 characters, possibly incorrectly encoded';
                    break;
                case JSON_ERROR_UTF16:
                    $json_error = 'Malformed UTF-16 characters, possibly incorrectly encoded';
                    break;
                default:
                    $json_error = 'Unknown JSON error';
                    break;
            }

            if (!empty($json_error)) {
                throw new RequestException('Unable to decode response JSON: ' . $json_error, $this, $response);
            }
        }

        // Always return an object, even when no body was sent in the response
        // or if the JSON decoding failed.
        if (empty($data)) {
            $data = new stdClass();
        }

        // Add the HTTP status code.
        $data->status_code = $response->getStatusCode();

        return $data;
    }

    /**
     * Initializes the $options property.
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        // Set options as necessary. Not every subclass will need this.
    }

    /**
     * Validates provided options.
     */
    public function validateOptions()
    {
        // Subclasses may want to add extra validation of options here.
    }

    /**
     * Gets the options array.
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Gets sendable data in the appropriate format for Guzzle.
     *
     * @link https://docs.guzzlephp.org/en/6.5/request-options.html
     *
     * @return array
     */
    public function getData(): array
    {
        // By default, we send data as query params so it's ready for GET requests.
        // Other HTTP methods may need to override this to use a different key.
        return [
            'query' => $this->getOptions(),
        ];
    }

    /**
     * Prepares the array with data to be sent along in the request.
     *
     * @return array
     */
    private function getRequestData(): array
    {
        // Every request needs authorization information.
        $data = [
            'auth' => [$this->config->secretKey(), ''],
        ];

        // Append other options if available.
        if (!count($this->options)) {
            $data += $this->getData();
        }

        return $data;
    }

    /**
     * Gets the end-point path.
     *
     * @return string
     */
    public function getPath(): string
    {
        $uri = $this->config->apiVersion() . $this->getUri()->getPath();

        // Add a token if available.
        if (strpos($uri, '__TOKEN__') !== false) {
            $token = $this->token ?? '';
            $uri = str_replace('__TOKEN__', $token, $uri);
        }

        return $uri;
    }

    /**
     * Gets the URL executed by the request.
     *
     * @return string
     */
    public function getURL(): string
    {
        $config = $this->httpClient->getConfig();
        /** @var \GuzzleHttp\Psr7\Uri $uri */
        $uri = $config['base_uri'];
        return $uri->getScheme() . '://' . $uri->getHost() . $uri->getPath() . $this->getPath();
    }
}
