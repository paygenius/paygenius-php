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

class Transaction
{
    public $reference;
    public $description;
    public $currency;
    public $amount;

    function __construct($reference = null, $description = null, $currency = null, $amount = null)
    {
        $this->reference   = $reference;
        $this->description = $description;
        $this->currency    = $currency;
        $this->amount      = $amount;
    }
}