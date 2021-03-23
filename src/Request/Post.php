<?php

declare(strict_types=1);

namespace Pin\Request;

use Pin\Request\Base as BaseRequest;

/**
 * POST request base class.
 *
 * @package Pin/Request
 */
abstract class Post extends BaseRequest
{
    /**
     * The HTTP method.
     *
     * @var string.
     */
    public const METHOD = 'POST';

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
