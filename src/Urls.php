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

class Urls implements Validateable
{
    public $success;
    public $cancel;
    public $error;

    function __construct($success, $error, $cancel = null)
    {
        $this->success = $success;
        $this->error   = $error;
        $this->cancel  = $cancel == null ? $error : $cancel;
    }

    public function validate()
    {
        $errors = [];

        if (Util\Validation::isEmpty($this->success)) {
            $errors['success'] = 'Missing';
        } elseif (!Util\Validation::isUrl($this->success)) {
            $errors['success'] = 'Invalid';
        }

        if (Util\Validation::isEmpty($this->cancel)) {
            $errors['cancel'] = 'Missing';
        } elseif (!Util\Validation::isUrl($this->cancel)) {
            $errors['cancel'] = 'Invalid';
        }

        if (Util\Validation::isEmpty($this->error)) {
            $errors['error'] = 'Missing';
        } elseif (!Util\Validation::isUrl($this->error)) {
            $errors['error'] = 'Invalid';
        }

        return $errors;
    }
}