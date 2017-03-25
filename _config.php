<?php

\Stripe\Stripe::setApiKey(
    Config::inst()->get('Stripe', 'secret_key')
);