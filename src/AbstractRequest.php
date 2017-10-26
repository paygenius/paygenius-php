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
 * Abstract request for all request objects.
 */
abstract class AbstractRequest implements Validateable
{
    public $time;
    private $endpoint;
    private $method;

    /**
     * Constructor for the base request.
     *
     * @param string $endpoint The endpoint to use.
     * @param string $method The request method.
     */
    function __construct($endpoint, $method = 'POST')
    {
        $this->time     = date('c');
        $this->endpoint = $endpoint;
        $this->method   = $method;
    }

    /**
     * Gets the endpoint for this request.
     *
     * @return string The endpoint for this request.
     */
    function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Gets the HTTP method for this request.
     *
     * @return string The HTTP method for this request.
     */
    function getMethod()
    {
        return $this->method;
    }
}