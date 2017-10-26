<?php
/*
 * Copyright (c) 2016 PayGenius
 * All rights reserved.
 *
 * This software is the confidential and proprietary information of PayGenius.
 * ("Confidential Information"). You shall not disclose such
 * Confidential Information and shall use it only in accordance with
 * the terms of the license agreement you entered into with PayGenius.
 */

namespace PayGenius;

class ValidateRequest extends AbstractRequest
{

    public function __construct()
    {
        parent::__construct('util/validate');
    }
}