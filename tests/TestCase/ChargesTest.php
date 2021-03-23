<?php

declare(strict_types=1);

namespace Pin\Tests\TestCase;

class ChargesTest extends TestRequest
{
    /**
     * Test for the charge capture class.
     */
    public function testCaptureCharge()
    {
        $uri_endpoint = '/charges/__TOKEN__/capture';
        $http_method = 'PUT';
        $data_key = 'form_params';
        $charge_token = 'ch_lfUYEBK14zotCTykezJkfg';

        $this->handler->createRequest('Pin\Charge\Capture', $charge_token);

        // Test request parameters.
        $request = $this->handler->getRequest();
        static::assertEquals($http_method, $request->getMethod());
        static::assertEquals($uri_endpoint, $request->getUri()->getPath());

        // Test sendable  data.
        $data = $request->getData();
        // PUT requests must use the "form_params" key to append sendable data.
        static::assertArrayHasKey($data_key, $data);
        // This endpoint accepts no additional data.
        static::assertEmpty($data[$data_key]);

        // Test URI path.
        $path = str_replace('__TOKEN__', $charge_token, $uri_endpoint);
        static::assertEquals($path, $request->getPath());
    }

    /**
     * Test for the charge create class.
     */
    public function testCreateCharge()
    {
        $uri_endpoint = '/charges';
        $http_method = 'POST';
        $data_key = 'form_params';

        $options = $this->getFixture('ChargeCreate');
        $this->handler->createRequest('Pin\Charge\Create', $options);

        // Test request parameters.
        $request = $this->handler->getRequest();
        static::assertEquals($http_method, $request->getMethod());
        static::assertEquals($uri_endpoint, $request->getUri()->getPath());

        // Test request options.
        $request_options = $request->getOptions();
        // Checks that options passed to the constructor have been set.
        static::assertEqualsCanonicalizing($options, $request_options);

        // Test sendable  data.
        $data = $request->getData();
        // POST requests must use the "form_params" key to append sendable data.
        static::assertArrayHasKey($data_key, $data);
        // Just ensuring request values have been assigned to the proper key.
        static::assertEqualsCanonicalizing($options, $data[$data_key]);

        // Test URI path.
        static::assertEquals($uri_endpoint, $request->getPath());

        // Test submission.
        $response_data = $this->getFixture('ChargeCreateResponse');
        $request_data = $this->mockSubmission($response_data, $request, 201);
        static::assertInstanceOf('stdClass', $request_data);
        static::assertEquals(201, $request_data->status_code);
    }
}
