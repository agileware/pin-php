<?php

declare(strict_types=1);

namespace Pin\Request;

use Pin\Request\Base as BaseRequest;

/**
 * PUT request base class.
 *
 * @package Pin/Request
 */
abstract class Put extends BaseRequest
{
    /**
     * The HTTP method.
     *
     * @var string.
     */
    public const METHOD = 'PUT';

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
