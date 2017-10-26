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

class CreatePaymentRequest extends AbstractRequest
{
    public $intent;
    public $creditCard;
    public $transaction;
    public $threeDSecure;
    public $consumer;

    function __construct($intent = null, $creditCard = null, $transaction = null, $threeDSecure = null, $consumer = null)
    {
        parent::__construct("payment/create");

        $this->intent       = $intent;
        $this->creditCard   = $creditCard;
        $this->transaction  = $transaction;
        $this->threeDSecure = $threeDSecure;
        $this->consumer     = $consumer;
    }
}