<?php

namespace Omnipay\PayPal\Message;

class VoidRequest extends AbstractRequest
{
    public function getData()
    {
        $data = $this->getBaseData();
        
        $data['METHOD']             = 'DoVoid';
        $data['AUTHORIZATIONID']    = $this->getTransactionReference();
        
        return $data;
    }
}
