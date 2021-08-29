<?php

namespace App\Entity;

use App\Repository\CurrencyRateRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass=CurrencyRateRepository::class)
 */
class CurrencyRate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Currency::class, inversedBy="currencyRates")
     * @ORM\JoinColumn(nullable=false)
     */
    private Currency $baseCurrency;

    /**
     * @ORM\ManyToOne(targetEntity=Currency::class, inversedBy="currenciesExchange")
     * @ORM\JoinColumn(nullable=false)
     */
    private Currency $currencyExchange;

    /**
     * @ORM\Column(type="float")
     */
    private string $cost;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $datetime;

    public function getId(): int
    {
        return $this->id;
    }

    public function getBaseCurrency(): Currency
    {
        return $this->baseCurrency;
    }

    public function setBaseCurrency(Currency $baseCurrency): self
    {
        $this->baseCurrency = $baseCurrency;

        return $this;
    }

    public function getCurrencyExchange(): Currency
    {
        return $this->currencyExchange;
    }

    public function setCurrencyExchange(Currency $currencyExchange): self
    {
        $this->currencyExchange = $currencyExchange;

        return $this;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

    public function setCost(float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getDatetime(): DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }
}
