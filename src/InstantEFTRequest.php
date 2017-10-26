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


class InstantEFTRequest extends CreatePaymentRequest
{
    public function __construct()
    {
        parent::__construct('payment/create/eft');
        unset($this->creditCard);
        unset($this->threeDSecure);
    }
}