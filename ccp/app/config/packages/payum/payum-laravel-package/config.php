<?php

use Payum\Core\Storage\FilesystemStorage;
use Payum\Core\Storage\FilesystemStorage;
use Payum\Paypal\ExpressCheckout\Nvp\Api;
use Payum\Paypal\ExpressCheckout\Nvp\PaymentFactory as PaypalPaymentFactory;



$detailsClass = 'Payum\Core\Model\ArrayObject';
$tokenClass = 'Payum\Core\Model\Token';

$paypalPayment = PaypalPaymentFactory::create(new Api(array(
    'username' => $_SERVER['payum.paypal_express_checkout.username'],
    'password' => $_SERVER['payum.paypal_express_checkout.password'],
    'signature' => $_SERVER['payum.paypal_express_checkout.signature'],
    'sandbox' => true
)));


return array(
    // You can pass on object or a service id from container.
    'token_storage' => new FilesystemStorage(__DIR__.'/../../../../storage/payments', $tokenClass, 'hash'),
    'payments' => array(
        // Put here any payment you want too, omnipay, payex, paypa, be2bill or any other. Here's example of paypal and stripe:
         'paypal_es' => $paypalPayment,
    ),
    'storages' => array(
        $detailsClass => new FilesystemStorage(__DIR__.'/../../../../storage/payments', $detailsClass),
    )
);