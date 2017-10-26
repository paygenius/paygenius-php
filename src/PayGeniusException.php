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

class PayGeniusException extends \Exception
{
    const TYPE_UNKNOWN        = 0;
    const TYPE_AUTHENTICATION = -1;
    const TYPE_VALIDATION     = -2;
    const TYPE_COMMUNICATION  = -3;

    function __construct($message, $code, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}