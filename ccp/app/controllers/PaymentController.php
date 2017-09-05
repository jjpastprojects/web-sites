<?php

class PaymentController extends BaseController
{
    public function done($payum_token)
    {
        /** @var Request $request */
        $request = \App::make('request');
        $request->attributes->set('payum_token', $payum_token);

        $token = $this->getHttpRequestVerifier()->verify($request);

        $payment = $this->getPayum()->getPayment($token->getPaymentName());

        $payment->execute($status = new GetHumanStatus($token));

        return \Response::json(array(
            'status' => $status->getValue(),
            'details' => iterator_to_array($status->getModel())
        ));
    }
    protected function getPayum()
        {
            return \App::make('payum');
        }

    protected function getHttpRequestVerifier()
        {
            return \App::make('payum.security.http_request_verifier');
        }
}