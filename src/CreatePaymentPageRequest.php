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
 * Creates a redirect payment page.
 */
class CreatePaymentPageRequest extends AbstractRequest
{
    public $page;

    /**
     * @var Urls
     */
    public $urls;

    /**
     * @var Consumer
     */
    public $consumer;

    /**
     * @var Transaction
     */
    public $transaction;

    /**
     *
     * @param \PayGenius\Transaction $transaction The transaction information.
     * @param \PayGenius\Consumer $consumer The consumer information.
     * @param \PayGenius\Urls $urls Contains the redirect URLs to return a client to.
     * @param number $page The ID of the payment page to use. This can be null if only one page exists.
     */
    function __construct(Transaction $transaction, Consumer $consumer, Urls $urls, $page = null)
    {
        parent::__construct('redirect/create', 'POST');
        
        $this->transaction = $transaction;
        $this->consumer    = $consumer;
        $this->urls        = $urls;
        $this->page        = $page;
    }

    public function validate()
    {

    }
}