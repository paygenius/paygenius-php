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

class PayGeniusValidationException extends PayGeniusException
{
    private $errors;

    function __construct($errors)
    {
        $this->errors = $errors;

        parent::__construct('Validation Error', parent::TYPE_VALIDATION);
    }

    function getErrors()
    {
        return $this->errors;
    }
}