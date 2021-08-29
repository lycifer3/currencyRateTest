<?php

namespace App\Manager;

use App\Entity\Currency;
use App\Entity\CurrencyRate;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;
use Exception;

class CurrencyRateManager
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Currency $baseCurrency
     * @param Currency[] $currencies
     * @param array $rates
     * @throws Exception
     */
    public function saveRates(Currency $baseCurrency, array $currencies, array $rates): void
    {
        foreach ($currencies as $currency) {
            $currencyRate = new CurrencyRate();
            $currencyRate
                ->setBaseCurrency($baseCurrency)
                ->setCurrencyExchange($currency)
                ->setCost($rates['bpi'][$currency->getCode()]['rate_float'])
                ->setDatetime(new DateTime($rates['time']['updatedISO']));

            $this->entityManager->persist($currencyRate);
        }

        $this->entityManager->flush();
    }
}