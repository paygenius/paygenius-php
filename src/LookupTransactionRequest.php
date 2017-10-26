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

/**
 * Looks up a transactions status
 */
class LookupTransactionRequest extends AbstractRequest
{
    public $reference;

    function __construct($reference)
    {
        parent::__construct('payment/%s', 'GET');

        $this->reference = $reference;
    }

    public function getEndpoint()
    {
        return sprintf(parent::getEndpoint(), $this->reference);
    }

    public function validate()
    {

    }
}