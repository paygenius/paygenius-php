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

class CreatePaymentRequest extends AbstractRequest
{
    public $threeDSecure;

    /**
     * @var Consumer
     */
    public $consumer;

    /**
     * @var Transaction
     */
    public $transaction;

    /**
     * @var CreditCard
     */
    public $creditCard;

    /**
     * @param \PayGenius\CreditCard $creditCard The credit card information.
     * @param \PayGenius\Transaction $transaction The transaction information.
     * @param \PayGenius\Consumer $consumer The consumer information.
     * @param boolean $threeDSecure Forces 3D secure to be enabled (setting this to false allows the server to decide)
     */
    function __construct(CreditCard $creditCard, Transaction $transaction, Consumer $consumer, $threeDSecure = false)
    {
        parent::__construct("payment/create");
        $this->creditCard   = $creditCard;
        $this->transaction  = $transaction;
        $this->consumer     = $consumer;
        $this->threeDSecure = $threeDSecure;
    }

    public function validate()
    {
        $errors = [];

        // Validate credit card
        if ($this->creditCard === null) {
            $errors['creditCard'] = 'Missing';
        } else {
            $creditCardErrors = $this->creditCard->validate();

            if (!empty($creditCardErrors)) {
                $errors['creditCard'] = $creditCardErrors;
            }
        }

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

        return $errors;
    }
}