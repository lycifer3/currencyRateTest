<?php

namespace App\Service\Client;

interface CurrencyClientInterface
{
    /**
     * Return bitcoin rates
     * @return array
     */
    public function getBitcoinRates(): array;
}