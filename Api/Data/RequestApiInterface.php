<?php

namespace Nans\RequestPrice\Api\Data;

interface RequestApiInterface
{
    /**
     * @param string $email
     * @param string $name
     * @param string $comment
     * @param string $sku
     * @return string
     */
    public function makeRequest(string $email, string $name, string $comment, string $sku): string;
}