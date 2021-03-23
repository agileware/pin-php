<?php

declare(strict_types=1);

namespace Pin\Tests\TestCase;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Pin\Handler as PinHandler;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class TestRequest extends TestCase
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var \Pin\Handler
     */
    protected $handler;

    protected function setUp(): void
    {
        $config = $this->createMock('Pin\Configuration');
        $this->handler = new PinHandler($config);
    }

    /**
     * Helper function, gets fixture contents.
     *
     * @param string $name
     *   A string matching the name of a file in the Fixture directory. The file
     *   must contain a function with the exact same name.
     *
     * @return mixed
     *   Whatever the fixture function call returns.
     */
    protected function getFixture(string $name)
    {
        $path = sprintf('%s/Fixture/%s.php', dirname(dirname(__FILE__)), $name);
        require_once $path;
        return $name();
    }

    /**
     * Prepares a mock request.
     *
     * @param int $status_code
     * @param null $data
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function mockResponse(int $status_code, $data = null): ResponseInterface
    {
        // Pin API returns JSON strings as response.
        if (!empty($data) && (is_array($data) || is_object($data))) {
            $data = json_encode($data);
        }

        // Set stream
        $stream = $this->createMock('Psr\Http\Message\StreamInterface');
        $stream->method('getContents')
            ->willReturn($data);

        // Set response
        $response = $this->createMock('Psr\Http\Message\ResponseInterface');
        $response->method('getStatusCode')
            ->willReturn($status_code);
        $response->method('getBody')
            ->willReturn($stream);

        return $response;
    }

    /**
     * Returns a mock version of the Guzzle HTTP client.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *   The response to be generated by the request.
     *
     * @return \GuzzleHttp\Client
     */
    public function mockClient(ResponseInterface $response): Client
    {
        $mock = new MockHandler([$response]);
        $handler_stack = HandlerStack::create($mock);
        return new Client(['handler' => $handler_stack]);
    }

    /**
     * Prepares and executes a mock submission.
     *
     * @param array $data
     *   Data to be returned by the request.
     * @param \Psr\Http\Message\RequestInterface $request
     *  The request to be sent.
     * @param int $status_code
     *   The HTTP status code generated by the request.
     *
     * @return object
     *   Request response object.
     */
    public function mockSubmission(array $data, RequestInterface $request, int $status_code = 200): object
    {
        $response = $this->mockResponse($status_code, $data);
        $client = $this->mockClient($response);
        $request->setHttpClient($client);
        return $this->handler->submit();
    }
}