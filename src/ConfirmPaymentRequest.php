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
 * Used to confirm 3D secure authorization.
 */
class ConfirmPaymentRequest extends AbstractRequest
{
    public $reference;
    public $paRes;

    /**
     * @param string $reference The PayGenius transaction reference.
     * @param string $paRes The PaRes value returned in the 3DS post back.
     */
    function __construct($reference = null, $paRes = null)
    {
        parent::__construct('payment/%s/confirm', 'POST');

        $this->reference = $reference;
        $this->paRes     = $paRes;
    }

    public function getEndpoint()
    {
        return sprintf(parent::getEndpoint(), $this->reference);
    }

    public function validate()
    {

    }
}