<?php

namespace Nans\RequestPrice\Api\Data;

interface RequestApiInterface
{
    /**
     * @return array
     */
    public function makeRequest(): array;
}