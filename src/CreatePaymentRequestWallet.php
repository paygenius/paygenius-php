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

class CreatePaymentRequestWallet extends AbstractRequest
{
    public $intent;
    public $creditCard;
    public $transaction;
    public $threeDSecure;
    public $consumer;

    function __construct($intent = null, $creditCard = null, $transaction = null, $threeDSecure = null, $consumer = nulL)
    {
        parent::__construct("payment/wallet");

        $this->intent       = $intent;
        $this->creditCard   = $creditCard;
        $this->transaction  = $transaction;
        $this->threeDSecure = $threeDSecure;
        $this->consumer     = $consumer;
    }
}