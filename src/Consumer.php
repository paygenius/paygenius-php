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
 * Object containing consumer information.
 */
class Consumer implements Validateable
{
    public $name;
    public $surname;
    public $email;

    /**
     * @param string $name The consumer's first name
     * @param string $surname The consumer's last name
     * @param string $email The consumer's email address
     */
    function __construct($name, $surname, $email)
    {
        $this->name    = $name;
        $this->surname = $surname;
        $this->email   = $email;
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