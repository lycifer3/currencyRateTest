<?php

namespace App\Dto;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use DateInterval;
use Exception;

class CurrencyRateDto
{
    const PERIOD_VARIANTS = ['P1H', 'P12H', 'P1D', 'P1W', 'P1M'];

    /**
     * @Assert\NotBlank
     * @Assert\Currency
     */
    private ?string $currency;

    /**
     * @Assert\NotBlank
     * @Assert\Choice(choices=self::PERIOD_VARIANTS)
     */
    private ?string $dateInterval;

    public function __construct(?string $currency, ?string $dateInterval)
    {
        $this->currency = $currency;
        $this->dateInterval = $dateInterval;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return DateInterval
     * @throws Exception
     */
    public function getDateInterval(): DateInterval
    {
        return new DateInterval($this->dateInterval);
    }

    public static function loadFromRequest(Request $request): self
    {
        return new self($request->query->get('currency'), $request->query->get('dateInterval'));
    }
}