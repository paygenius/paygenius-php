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

class PayGeniusAuthenticationException extends PayGeniusException
{

    function __construct()
    {
        parent::__construct("Authentication Failure", parent::TYPE_AUTHENTICATION);
    }
}