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

class CreditCard extends PaymentMethod
{
    const TYPE_VISA             = 'visa';
    const TYPE_AMERICAN_EXPRESS = 'amex';
    const TYPE_DINERS_CLUB      = 'diners';
    const TYPE_MASTERCARD       = 'mastercard';

    public $number;
    public $cardHolder;
    public $expiryYear;
    public $expiryMonth;
    public $cvv;
    public $type;

    /**
     * @param string $number The credit card number
     * @param string $cardHolder The card holder name
     * @param integer $expiryYear The expiry year (in the format yyyy)
     * @param integer $expiryMonth The expiry month
     * @param string $cvv The CVV number
     * @param string $type The card type (visa/mastercard/amex/diners)
     */
    function __construct($number, $cardHolder, $expiryYear, $expiryMonth, $cvv, $type = null)
    {
        parent::__construct('creditcard');

        $this->number      = $number;
        $this->cardHolder  = $cardHolder;
        $this->expiryYear  = intval($expiryYear);
        $this->expiryMonth = intval($expiryMonth);
        $this->cvv         = (string) $cvv;
        $this->type        = $type;
    }

    public function validate()
    {
        $errors = [];

        if (Util\Validation::isEmpty($this->number)) {
            $errors['number'] = 'Missing';
        } else if (class_exists('\Inacho\CreditCard')) {
            $this->validateCard($errors);
        }

        if (Util\Validation::isEmpty($this->cardHolder)) {
            $errors['cardHolder'] = 'Missing';
        }

        if (Util\Validation::isEmpty($this->cvv)) {
            $errors['cvv'] = 'Missing';
        }

        if (Util\Validation::isEmpty($this->cardHolder)) {
            $errors['cardHolder'] = 'Missing';
        }

        if (Util\Validation::isEmpty($this->cvv)) {
            $errors['type'] = 'Missing';
        }

        return $errors;
    }

    private function validateDate(&$errors)
    {
        $currentYear  = (int) date('Y');
        $currentMonth = (int) date('n');

        if (!strlen((string) $this->expiryYear) !== 4) {
            $errors['expiryYear'] = 'Invalid';

            return;
        }

        if ($this->expiryYear < $currentYear ||
            ($this->expiryYear == $currentYear && $this->expiryMonth < $currentMonth)) {

            $errors['expiryYear']  = 'Expired';
            $errors['expiryMonth'] = 'Expired';
        }
    }

    private function validateCard(&$errors)
    {
        $card = \Inacho\CreditCard::validCreditCard($this->number);

        if (!$card['valid']) {
            $errors['number'] = 'Invalid';
        } else {
            $type = $card['type'] == 'dinersclub' ? self::TYPE_DINERS_CLUB : $card['type'];
            if (Util\Validation::isEmpty($this->type)) {
                $this->type = $type;
            } else if ($this->type !== $type || !in_array($this->type,
                    [self::TYPE_AMERICAN_EXPRESS, self::TYPE_DINERS_CLUB, self::TYPE_MASTERCARD, self::TYPE_VISA])) {

                $errors['type'] = 'Invalid';
            }
        }
    }
}