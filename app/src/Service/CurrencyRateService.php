<?php

namespace App\Service;

use App\Manager\CurrencyRateManager;
use App\Repository\CurrencyRepository;
use App\Service\Client\CurrencyClientInterface;
use Doctrine\Persistence\ObjectRepository;
use Exception;

class CurrencyRateService
{
    private CurrencyClientInterface $client;
    private ObjectRepository $currencyRepository;
    private CurrencyRateManager $currencyRateManager;

    public function __construct(
        CurrencyClientInterface $client,
        CurrencyRepository $currencyRepository,
        CurrencyRateManager $currencyRateManager
    )
    {
        $this->client = $client;
        $this->currencyRepository = $currencyRepository;
        $this->currencyRateManager = $currencyRateManager;
    }

    /**
     * @throws Exception
     */
    public function updateBitcoinRate(): void
    {
        $bitcoin = $this->currencyRepository->findOneByCode(CurrencyRepository::BASE_CURRENCY);
        $currencies = $this->currencyRepository->findAllExchanges();
        $rates = $this->client->getBitcoinRates();

        $this->currencyRateManager->saveRates($bitcoin, $currencies, $rates);
    }
}