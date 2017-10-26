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

namespace PayGenius\Util;

class Validation
{

    private function __construct()
    {

    }

    public static function isEmpty($string)
    {
        return $string === null || $string === '';
    }

    public function isEmail($email)
    {
        if (self::isEmpty($email)) {
            return false;
        }

        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function isUrl($url)
    {
        if (self::isEmpty($url)) {
            return false;
        }

        return filter_var($url, FILTER_VALIDATE_URL);
    }
}