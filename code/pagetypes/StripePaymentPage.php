<?php

class StripePaymentPage extends Page
{
    private static $icon = 'stripe-payment-page/stripe-favicon.ico';
    private static $db = [
        'StripeAPIKey' => 'Varchar(80)',
        'AcceptBitcoin' => 'Boolean'
    ];

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.Main', [
            TextField::create('StripeAPIKey'),
            CheckboxField::create('AcceptBitcoin')
                ->setDescription('Bitcoin payments are only processed within the USA.
                    However, Stripe is still happy to take your money.')
        ], 'Content');

        return $fields;
    }
}

class StripePaymentPage_Controller extends Page_Controller
{
    private static $allowed_actions = [
        'accept'
    ];
}