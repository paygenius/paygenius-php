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


class CardLookupRequest extends AbstractRequest
{
    public $cardNumber;

    public function __construct($cardNumber)
    {
        parent::__construct('card/lookup', 'POST');
        $this->cardNumber = $cardNumber;
    }
}
