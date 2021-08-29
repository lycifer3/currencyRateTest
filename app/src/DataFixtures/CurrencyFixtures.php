<?php

namespace App\DataFixtures;

use App\Entity\Currency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CurrencyFixtures extends Fixture
{
    const CURRENCIES = [
        ['code' => 'USD', 'name' => 'Dollar', 'symbol' => '&#36;'],
        ['code' => 'GBP', 'name' => 'Pound', 'symbol' => '&pound;'],
        ['code' => 'EUR', 'name' => 'Euro', 'symbol' => '&euro;'],
        ['code' => 'BTC', 'name' => 'Bitcoin', 'symbol' => '&#8383;']
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CURRENCIES as $currency) {
            $currencyModel = new Currency();
            $currencyModel->setCode($currency['code']);
            $currencyModel->setName($currency['name']);
            $currencyModel->setSymbol($currency['symbol']);

            $manager->persist($currencyModel);
        }

        $manager->flush();
    }
}
