<?php

namespace Omnipay\PayPal\Message;

/**
 * PayPal REST Create Card Request
 */
class RestCreateCardRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('card');
        $this->getCard()->validate();

        $data = array(
            'number' => $this->getCard()->getNumber(),
            'type' => $this->getCard()->getBrand(),
            'expire_month' => $this->getCard()->getExpiryMonth(),
            'expire_year' => $this->getCard()->getExpiryYear(),
            'cvv2' => $this->getCard()->getCvv(),
            'first_name' => $this->getCard()->getFirstName(),
            'last_name' => $this->getCard()->getLastName(),
            'billing_address' => array(
                'line1' => $this->getCard()->getAddress1(),
                //'line2' => $this->getCard()->getAddress2(),
                'city' => $this->getCard()->getCity(),
                'state' => $this->getCard()->getState(),
                'postal_code' => $this->getCard()->getPostcode(),
                'country_code' => strtoupper($this->getCard()->getCountry()),
            )
        );

        // There's currently a quirk with the REST API that requires line2 to be
        // non-empty if it's present. Jul 14, 2014
        $line2 = $this->getCard()->getAddress2();
        if (!empty($line2)) {
            $data['billing_address']['line2'] = $line2;
        }

        return $data;
    }

    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/vault/credit-card';
    }
}
