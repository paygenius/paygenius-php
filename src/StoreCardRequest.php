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

namespace App\Intergration\PayGenius;


class StoreCardRequest extends AbstractRequest
{
    public $number;
    public $cardHolder;
    public $expiryYear;
    public $expiryMonth;
    public $type;
    public $cvv;

    /**
     * StoreCardRequest constructor.
     */
    public function __construct($number = null, $cardHolder = null, $expiryYear = null, $expiryMonth = null, $type = null, $cvv = null)
    {
        parent::__construct('card/register');

        $this->number       = $number;
        $this->cardHolder   = $cardHolder;
        $this->expiryYear   = (int)$expiryYear;
        $this->expiryMonth  = (int)$expiryMonth;
        $this->type         = $type;
        $this->cvv          = (int)$cvv;
    }
}