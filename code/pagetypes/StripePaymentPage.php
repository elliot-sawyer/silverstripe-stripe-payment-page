<?php

class StripePaymentPage extends Page
{
    private static $icon = 'stripe-payment-page/stripe-favicon.ico';
    private static $db = [
        'AcceptBitcoin' => 'Boolean'
    ];

    public function getCMSFields() {
        $fields = parent::getCMSFields();

//@todo enable bitcoin payments. This needs extra work on the charge action
        $fields->addFieldsToTab('Root.Main', [
            // CheckboxField::create('AcceptBitcoin')
            //     ->setDescription('Bitcoin payments are only processed within the USA.
            //         However, Stripe is still happy to take your money.')
        ], 'Content');

        return $fields;
    }

    public function getPublishableKey()
    {
        return Config::inst()->get('Stripe', 'publishable_key');
    }
}

class StripePaymentPage_Controller extends Page_Controller
{
    private static $allowed_actions = [
        'charge',
        'success'
    ];

    public function charge($request)
    {
        $post = $request->postVars();

        $token  = $post['stripeToken'];
        $email = $post['stripeEmail'];

        if($token && Email::is_valid_address($email)) {
            $key = Config::inst()->get('Stripe', 'secret_key');
            \Stripe\Stripe::setApiKey($key);
            $customer = \Stripe\Customer::create(array(
                'email' => $email,
                'source'  => $token
            ));

            //charge $50
            //@todo We'd get the real price by querying an order_id passed in from the form'
            $charge = \Stripe\Charge::create(array(
                'customer' => $customer->id,
                'amount'   => 5000,
                'currency' => 'usd'
            ));

            $values = (array) $charge;
            // debug::dump([$values, $charge->amount, $charge->currency]);

            return $this->customise([
              'Amount' => number_format($charge->amount / 100, 2),
              'Currency' => $charge->currency
            ])->renderWith(['StripePaymentPage_success', 'Page']);
        }
    }

}