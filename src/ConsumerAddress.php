<?php
/*
 * Copyright (c) 2021 Methys Digital
 * All rights reserved.
 *
 * This software is the confidential and proprietary information of Methys Digital.
 * ("Confidential Information"). You shall not disclose such
 * Confidential Information and shall use it only in accordance with
 * the terms of the license agreement you entered into with Methys Digital.
 */

namespace PayGenius;

/**
 * Object containing Consumer Address information.
 */
class ConsumerAddress implements Validateable
{
    public $addressLineOne;
    public $city;
    public $postCode;
    public $country;
    

    /**
     * @param string $addressLineOne The consumer's address line one
     * @param string $city The consumer's city
     * @param string $postCode The consumer's postcode
     * @param string $country The consumer's country code (two digits upper case : eg. 'ZA')
     */
    function __construct($addressLineOne, $city, $postCode, $country)
    {
        $this->addressLineOne    = $addressLineOne;
        $this->city = $city;
        $this->postCode   = $postCode;
        $this->country    = $country;
    }

    public function validate()
    {
        $errors = [];

        if (Util\Validation::isEmpty($this->name)) {
            $errors['name'] = 'Missing';
        }

        if (Util\Validation::isEmpty($this->surname)) {
            $errors['surname'] = 'Missing';
        }

        if (Util\Validation::isEmpty($this->email)) {
            $errors['email'] = 'Missing';
        } else if (!Util\Validation::isEmail($this->email)) {
            $errors['email'] = 'Invalid';
        }

        return $errors;
    }
}