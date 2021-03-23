<?php

/**
 * @return array
 */
function CardCreateResponse(): array
{
    return [
        'response' => [
            'token' => 'card_pIQJKMs93GsCc9vLSLevbw',
            'scheme' => 'master',
            'display_number' => 'XXXX-XXXX-XXXX-0000',
            'issuing_country' => 'US',
            'expiry_month' => 12,
            'expiry_year' => 2023,
            'name' => 'Roland Robot',
            'address_line1' => '42 Sevenoaks St',
            'address_line2' => null,
            'address_city' => 'Lathlain',
            'address_postcode' => '6454',
            'address_state' => 'WA',
            'address_country' => 'Australia',
            'customer_token' => null,
            'primary' => null,
        ],
        'ip_address' => '127.0.0.1',
    ];
}
