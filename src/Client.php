<?php
/*
 * Copyright (c) 2016 Methys Digital
 * All rights reserved.
 *
 * This software is the confidential and proprietary information of Methys Digital.
 * ("Confidential Information"). You shall not disclose such
 * Confidential Information and shall use it only in accordance with
 * the terms of the license agreement you entered into with Methys Digital.
 */

namespace PayGenius;

use Closure;

/**
 * The client library for making requests to PayGenius
 */
class Client
{
    private $token;
    private $secret;
    private $endpoint;
    private $logger;

    /**
     * Instantiates the PayGenius client library.
     *
     * @param string $token The PayGenius application token
     * @param string $secret The PayGenius secret key
     * @param string $endpoint The base PayGenius end point URL
     * 
     * @param Closure $logger A Closure that accepts the message to print. This should be null in production.
     */
    function __construct($token, $secret, $endpoint, $logger = null)
    {
        $this->token    = $token;
        $this->secret   = $secret;
        $this->endpoint = $endpoint;
        $this->logger   = $logger;
    }

    /**
     * Creates a credit card payment.
     *
     * @param CreatePaymentRequest $request
     * @return type
     */
    public function createPayment(CreatePaymentRequest $request)
    {
        return $this->send($request);
    }

    /**
     * Creates an instant EFT payment.
     *
     * @param CreateInstantEftPaymentRequest $request
     * @return type
     */
    public function createEftPayment(CreateInstantEftPaymentRequest $request)
    {
        return $this->send($request);
    }

    /**
     * Creates a hosted payment page request.
     *
     * @param PaymentPageRequest $paymentPageRequest
     * @return type
     */
    public function createPaymentPage(CreatePaymentPageRequest $paymentPageRequest)
    {
        return $this->send($paymentPageRequest);
    }

    /**
     * Executes a credit card payment.
     *
     * @param ExecutePaymentRequest $request
     * @return type
     */
    public function executePayment(ExecutePaymentRequest $request)
    {
        return $this->send($request);
    }

    /**
     * Confirms a 3DS authorization.
     *
     * @param ConfirmPaymentRequest $request
     * @return type
     */
    public function confirmPayment(ConfirmPaymentRequest $request)
    {
        return $this->send($request);
    }

    /**
     * Looks up a transaction by reference
     * 
     * @param LookupTransactionRequest $request
     * @return type
     */
    public function lookupTransaction(LookupTransactionRequest $request)
    {
        return $this->send($request);
    }

    /**
     * Validation service to test API calls.
     *
     * @param ValidateRequest $request
     * @return type
     */
    public function validate(ValidateRequest $request)
    {
        return $this->send($request);
    }

    public function lookupPage(PageLookupRequest $request)
    {
        return $this->send($request);
    }

    private function send(AbstractRequest $request)
    {
        $errors = $request->validate();
        if (!empty($errors)) {
            throw new PayGeniusValidationException($errors);
        }

        $endpoint = $this->endpoint.'/'.$request->getEndpoint();

        $this->log(sprintf('PayGenius %s Request: %s', $request->getMethod(), $endpoint));

        $ch = curl_init($endpoint);

        if ($request->getMethod() === 'POST') {
            $json = json_encode($request);

            $this->logBody($json, "Request Body");

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

            $headers = [
                'Content-Type: application/json',
                'Content-Length: '.strlen($json),
                'X-Token: '.$this->token,
                'X-Signature: '.$this->sign($endpoint, $json)
            ];
        } else {
            $headers = [
                'X-Token: '.$this->token,
                'X-Signature: '.$this->sign($endpoint)
            ];
        }

        $this->logHeaders($headers);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result   = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (!empty($result)) {
            $this->logBody($result, "Response Body");
        }

        if ($httpcode === 0) {
            throw new PayGeniusCommunicationException();
        } elseif ($httpcode === 403) {
            throw new PayGeniusAuthenticationException();
        } elseif ($httpcode !== 200) {
            throw new PayGeniusException("Received response code ".$httpcode, PayGeniusException::TYPE_UNKNOWN);
        }

        $response = json_decode($result);

        if (!$response->success === true) {
            throw new PayGeniusApiException($response);
        }

        return $response;
    }

    private function sign($endpoint, $request = '')
    {
        $toSign = trim($endpoint."\n".$request);

        return hash_hmac('sha256', $toSign, $this->secret);
    }

    private function log($message)
    {
        if (!$this->logger instanceof Closure) {
            return;
        }

        ($this->logger)($message."\n");
    }

    private function logHeaders($headers)
    {
        if (!$this->logger instanceof Closure) {
            return;
        }

        $message = "\tHeaders\n";

        foreach ($headers as $k => $v) {
            $message .= sprintf("\t\t%s\n", $v);
        }

        $this->log(rtrim($message));
    }

    private function logBody($json, $title)
    {
        if (!$this->logger instanceof Closure) {
            return;
        }

        // Ensure pretty printing
        $json = @json_encode(json_decode($json), JSON_PRETTY_PRINT);

        if (empty($json)) {
            return;
        }

        $json = explode("\n", $json);

        $message = "\t".$title."\n";

        foreach ($json as $line) {
            $message .= "\t\t".$line."\n";
        }

        $this->log(rtrim($message));
    }
}