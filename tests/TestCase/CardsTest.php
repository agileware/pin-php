<?php

declare(strict_types=1);

namespace Pin\Tests\TestCase;

class CardsTest extends TestRequest
{
    /**
     * Test for the card creation class.
     */
    public function testCreateCard()
    {
        $uri_endpoint = '/cards';
        $http_method = 'POST';
        $data_key = 'form_params';

        // Prepare the request.
        $options = $this->getFixture('CardCreate');
        $this->handler->createRequest('Pin\Card\Create', $options);
        $request = $this->handler->getRequest();

        // Test request parameters.
        static::assertEquals($http_method, $request->getMethod());
        static::assertEquals($uri_endpoint, $request->getUri()->getPath());

        // Test request options.
        $request_options = $request->getOptions();
        // Checks that all options passed to the constructor have been set.
        static::assertEqualsCanonicalizing($options, $request_options);

        // Test sendable  data.
        $data = $request->getRequestData();
        // POST requests must use the "form_params" key to append sendable data.
        static::assertArrayHasKey($data_key, $data);
        // Ensure that request values have been assigned to the proper key.
        static::assertEqualsCanonicalizing($options, $data[$data_key]);

        // Test URI path.
        static::assertEquals($uri_endpoint, $request->getPath());

        // Test submission.
        $response_data = $this->getFixture('CardCreateResponse');
        $request_data = $this->mockSubmission($response_data, $request, 201);
        static::assertInstanceOf('stdClass', $request_data);
        static::assertEquals(201, $request_data->status_code);
    }
}
