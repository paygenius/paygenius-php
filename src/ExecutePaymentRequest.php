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

class ExecutePaymentRequest extends AbstractRequest
{
    public $reference;

    function __construct($reference = null, $method = 'GET')
    {
        parent::__construct('payment/%s/execute', $method);

        $this->reference = $reference;
    }

    public function getEndpoint()
    {
        return sprintf(parent::getEndpoint(), $this->reference);
    }
}