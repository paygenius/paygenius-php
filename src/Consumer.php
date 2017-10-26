<?php
/*
 * Copyright (c) 2016 Powertime
 * All rights reserved.
 *
 * This software is the confidential and proprietary information of Powertime.
 * ("Confidential Information"). You shall not disclose such
 * Confidential Information and shall use it only in accordance with
 * the terms of the license agreement you entered into with Powertime.
 */

namespace PayGenius;

class Consumer
{
    public $name;
    public $surname;
    public $email;

    function __construct($name, $surname, $email)
    {
        $this->name    = $name;
        $this->surname = $surname;
        $this->email   = $email;
    }
}