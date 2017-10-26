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

class Transaction implements Validateable
{
    public $reference;
    public $description;
    public $currency;
    public $amount;

    /**
     * @param string $reference A free-form merchant reference.
     * @param string $currency The currency to use (ZAR).
     * @param integer $amount The payment amount in cents.
     */
    function __construct($reference = null, $currency = null, $amount = null)
    {
        $this->reference   = $reference;
        $this->description = '';
        $this->currency    = $currency;
        $this->amount      = is_numeric($amount) ? intval($amount) : null;
    }

    public function validate()
    {
        $errors = [];

        if (Util\Validation::isEmpty($this->reference)) {
            $errors['reference'] = 'Missing';
        }

        if (Util\Validation::isEmpty($this->currency)) {
            $errors['currency'] = 'Missing';
        } elseif ($this->currency !== 'ZAR') {
            $errors['curreny'] = 'Invalid';
        }

        if ($this->amount === null || $this->amount <= 0) {
            $errors['amount'] = 'Invalid';
        }

        return $errors;
    }
}