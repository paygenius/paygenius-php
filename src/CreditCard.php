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

class CreditCard extends AbstractRequest
{
    public $number;
    public $cardHolder;
    public $expiryYear;
    public $expiryMonth;
    public $cvv;
    public $type;
    public $uniqueId;

    function __construct($number = null, $cardHolder = null, $expiryYear = null, $expiryMonth = null, $cvv = null,
                         $type = null, $uniqueId = null)
    {
        parent::__construct('creditcard');

        $this->number      = $number;
        $this->cardHolder  = $cardHolder;
        $this->expiryYear  = $expiryYear;
        $this->expiryMonth = $expiryMonth;
        $this->cvv         = $cvv;
        $this->type        = $type;
        $this->uniqueId    = $uniqueId;
    }
}