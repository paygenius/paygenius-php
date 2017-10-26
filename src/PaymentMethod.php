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
 * Description of PaymentMethod
 *
 * @author william
 */
abstract class PaymentMethod implements Validateable
{
    public $method;

    function __construct($method)
    {
        $this->method = $method;
    }
}