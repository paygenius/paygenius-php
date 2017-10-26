<?php
/*
 * Copyright (c) 2016 Powertime
 * All rights reserved.
 *
 * This software is the confidential and proprietary information of Powertime.
 * ("Confidential Information"). You shall not disclose such
 * Confidential Information and shall use it only in accordance with
 * the terms of the license agreement you entered into with Powertime.
 */

namespace PayGenius;

use Exception;

class Client
{
    private $token;
    private $secret;
    private $endpoint;

    function __construct($token, $secret, $endpoint)
    {
        $this->token    = $token;
        $this->secret   = $secret;
        $this->endpoint = $endpoint;
    }

    public function createPayment(CreatePaymentRequest $request)
    {
        return $this->send($request);
    }

    public function lookupTransaction(TransctionLookupRequest $request)
    {
        return $this->send($request);
    }


    public function lookupCard(CardLookupRequest $request)
    {
        return $this->send($request);
    }

    public function storeCard(StoreCardRequest $request)
    {
        return $this->send($request);
    }

    public function createEftPayment(CreateInstantEftPaymentRequest $request)
    {
        return $this->send($request);
    }

    public function createPaymentWallet(CreatePaymentRequestWallet $request)
    {
        return $this->send($request);
    }

    public function executePayment(ExecutePaymentRequest $request)
    {
        return $this->send($request);
    }

    public function confirmPayment(ConfirmPaymentRequest $request)
    {
        return $this->send($request);
    }

    public function executeRefund(ExecutePaymentRefund $refund)
    {
        return $this->send($refund);
    }

    public function fetchPaymentPage($urlKey)
    {
        return $this->send($urlKey);
    }

    public function validate(ValidateRequest $request)
    {
        return $this->send($request);
    }

    private function send(AbstractRequest $request)
    {

        $endpoint = $this->endpoint.'/'.$request->getEndpoint();
        $ch = curl_init($endpoint);


        if ($request->getMethod() === 'POST') {
            $json = json_encode($request);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            //curl_setopt($ch, CURLOPT_RESOLVE, ["www.paygenius.co.za:443:196.40.100.154"]);

            curl_setopt($ch, CURLOPT_HTTPHEADER,
                [
                'Content-Type: application/json',
                'Content-Length: '.strlen($json),
                'X-Token: '.$this->token,
                'X-Signature: '.$this->sign($endpoint, $json)]
            );
        } else {
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                [
                'X-Token: '.$this->token,
                'X-Signature: '.$this->sign($endpoint)]
            );
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result   = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpcode !== 200) {
            die($result);
            throw new Exception("Received response code ".$httpcode);
        }
        
        return json_decode($result);
    }

    private function sign($endpoint, $request = '')
    {
        $toSign = trim($endpoint."\n".$request);

        return hash_hmac('sha256', $toSign, $this->secret);
    }
}
