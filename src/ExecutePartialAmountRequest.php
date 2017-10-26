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


class ExecutePartialAmountRequest extends ExecutePaymentRequest
{
    public $transaction = array();

    /**
     * ExecutePartialAmountRequest constructor.
     * @param null $reference
     * @param int $amount
     * @param string $currency
     */
    public function __construct($reference, $amount, $currency = 'ZAR')
    {
        parent::__construct($reference, 'POST');

        $this->transaction['amount']    = $amount;
        $this->transaction['currency']  = $currency;
    }
}