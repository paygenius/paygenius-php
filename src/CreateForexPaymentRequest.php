<?php
/*
 * Copyright (c) 2021 Methys Digital
 * All rights reserved.
 *
 * This software is the confidential and proprietary information of Methys Digital.
 * ("Confidential Information"). You shall not disclose such
 * Confidential Information and shall use it only in accordance with
 * the terms of the license agreement you entered into with Methys Digital.
 */

namespace PayGenius;

class CreateForexPaymentRequest extends AbstractRequest
{

    /**
     * @var Consumer
     */
    public $consumer;

    /**
     * @var Transaction
     */
    public $transaction;

    /**
     * @var Urls
     */
    public $urls;

    public $reference;

    public $authorize;

    public $allowMultiCurrencyPurchase;

    public $threeDSecure;
    
    public $transactionDate;

    public $pax;

    /**
     * @param \PayGenius\Transaction $transaction The transaction information.
     * @param \PayGenius\Consumer $consumer The consumer information. consumerAddress is required
     * @param \PayGenius\Urls $urls Contains the redirect URLs to return a client to.
     * @param string $reference The merchant reference for this payment
     * @param boolean $authorize If set to true, the funds will only be authorized, but not transfered (default false)
     * @param boolean $allowMultiCurrencyPurchase Specify whether the consumer is allowed to pay in a different currency than the merchant base currency (in the transaction object currency) (default false)
     * @param boolean $threeDSecure Forces 3D secure to be enabled Default to true
     * @param string $transactionDate The travel/booking date or the date that the goods is purchased (format - 'yyyy-MM-dd') (default today)
     * @param int $pax The number of people travelling (if travel booking) or the number of items / packages (default 1)
     */
    function __construct(Consumer $consumer, Transaction $transaction, Urls $urls, $reference, $authorize = false, $allowMultiCurrencyPurchase = false,  $threeDSecure = true, $transactionDate = null, $pax = 1)
    {
        parent::__construct("payment/create", "POST", "v3");
        $this->consumer      = $consumer;
        $this->transaction   = $transaction;
        $this->urls          = $urls;
        $this->reference     = $reference;
        $this->authorize     = $authorize;

        $this->allowMultiCurrencyPurchase = $allowMultiCurrencyPurchase;
        $this->threeDSecure  = $threeDSecure;
        if ($transactionDate == null) {
            $transactionDate = date('Y-m-d');
        }
        $this->transactionDate = $transactionDate;
        $this->pax = $pax;
        
    }

    public function validate()
    {
        $errors = [];
        // Validate transaction
        if ($this->transaction === null) {
            $errors['transaction'] = 'Missing';
        } else {
            $transactionErrors = $this->transaction->validate();

            if (!empty($transactionErrors)) {
                $errors['transaction'] = $transactionErrors;
            } else {
                if ($this->transaction->currency == 'ZAR') {
                    $errors['transaction.currency'] = 'ZAR not allowed on this API. Please use CreatePaymentRequest';
                }
            }
        }

        // Validate consumer
        if ($this->consumer === null) {
            $errors['consumer'] = 'Missing';
        } else {
            $consumerErrors = $this->consumer->validate();

            if (!empty($consumerErrors)) {
                $errors['consumer'] = $consumerErrors;
            }
        }

        // Validate urls
        if ($this->urls === null) {
            $errors['urls'] = 'Missing';
        } else {
            $urlsErrors = $this->urls->validate();

            if (!empty($urlsErrors)) {
                $errors['urls'] = $urlsErrors;
            }
        }

        if (Util\Validation::isEmpty($this->reference)) {
            $errors['reference'] = 'Missing';
        }
        
        return $errors;
    }
}