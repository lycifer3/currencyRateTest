<?php

namespace App\Serializer;

use App\Entity\CurrencyRate;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CurrencyRateNormalizer implements ContextAwareNormalizerInterface
{
    /**
     * @param CurrencyRate $currencyRate
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($currencyRate, string $format = null, array $context = [])
    {
        return [
            'code' => $currencyRate->getCurrencyExchange()->getCode(),
            'rate' => $currencyRate->getCost(),
            'datetime' => $currencyRate->getDatetime()
        ];
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof CurrencyRate;
    }
}