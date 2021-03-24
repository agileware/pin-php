<?php

/**
 * @return array
 */
function ChargeCreate(): array
{
    return [
        'amount' => 500,
        'description' => 'This is a test charge',
        'email' => 'roland@pinpayments.com',
        'ip_address' => '127.0.0.1',
        'currency' => 'AUD',
        'card' => [
            'number' => '4200000000000000',
            'expiry_month' => '12',
            'expiry_year' => '2023',
            'cvc' => '123',
            'name' => 'Roland Robot',
            'address_line1' => '42 Sevenoaks St',
            'address_line2' => '',
            'address_city' => 'Lathlain',
            'address_postcode' => '6454',
            'address_state' => 'WA',
            'address_country' => 'Australia',
        ],
        'capture' => true,
        'metadata' => [
            'option_1' => 'Metadata option 1',
            'option_2' => 'Metadata option 2',
            'option_3' => 'Metadata option 3',
        ],
    ];
}
