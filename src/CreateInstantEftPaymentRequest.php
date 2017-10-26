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

class CreateInstantEftPaymentRequest extends AbstractRequest
{
    /**
     * @var Urls
     */
    public $urls;

    /**
     * @var Consumer
     */
    public $consumer;

    /**
     * @var Transaction
     */
    public $transaction;

    /**
     * @param \PayGenius\Transaction $transaction The transaction information.
     * @param \PayGenius\Consumer $consumer The consumer information.
     * @param \PayGenius\Urls $urls The return urls
     * @param boolean $threeDSecure Forces 3D secure to be enabled (setting this to false allows the server to decide)
     */
    public function __construct(Transaction $transaction, Consumer $consumer, Urls $urls)
    {
        parent::__construct('payment/create/eft', 'POST');
        $this->transaction = $transaction;
        $this->consumer    = $consumer;
        $this->urls        = $urls;
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

        // Validate consumer
        if ($this->urls === null) {
            $errors['urls'] = 'Missing';
        } else {
            $urlsErrors = $this->urls->validate();

            if (!empty($urlsErrors)) {
                $errors['urls'] = $urlsErrors;
            }
        }

        return $errors;
    }
}