<?php

declare(strict_types=1);

namespace Pin\Request;

use Pin\Request\Base as BaseRequest;

/**
 * PATCH request base class.
 *
 * @package Pin/Request
 */
abstract class Patch extends BaseRequest
{
    /**
     * The HTTP method.
     *
     * @var string.
     */
    public const METHOD = 'PATCH';

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        return [
            'form_params' => $this->options,
        ];
    }
}
