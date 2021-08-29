<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=CurrencyRepository::class)
 */
class Currency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=3, unique=true)
     */
    private string $code;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private string $symbol;

    /**
     * @ORM\OneToMany(targetEntity=CurrencyRate::class, mappedBy="baseCurrency")
     */
    private Collection $currencyRates;

    /**
     * @ORM\OneToMany(targetEntity=CurrencyRate::class, mappedBy="currencyExchange")
     */
    private Collection $currenciesExchange;

    /**
     * Currency constructor
     */
    public function __construct()
    {
        $this->currencyRates = new ArrayCollection();
        $this->currenciesExchange = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(?string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * @return Collection|CurrencyRate[]
     */
    public function getCurrencyRates(): Collection
    {
        return $this->currencyRates;
    }

    public function addCurrencyRate(CurrencyRate $currencyRate): self
    {
        if (!$this->currencyRates->contains($currencyRate)) {
            $this->currencyRates[] = $currencyRate;
            $currencyRate->setBaseCurrency($this);
        }

        return $this;
    }

    public function removeCurrencyRate(CurrencyRate $currencyRate): self
    {
        if ($this->currencyRates->removeElement($currencyRate)) {
            // set the owning side to null (unless already changed)
            if ($currencyRate->getBaseCurrency() === $this) {
                $currencyRate->setBaseCurrency(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CurrencyRate[]
     */
    public function getCurrenciesExchange(): Collection
    {
        return $this->currenciesExchange;
    }

    public function addCurrenciesExchange(CurrencyRate $currenciesExchange): self
    {
        if (!$this->currenciesExchange->contains($currenciesExchange)) {
            $this->currenciesExchange[] = $currenciesExchange;
            $currenciesExchange->setCurrencyExchage($this);
        }

        return $this;
    }

    public function removeCurrenciesExchange(CurrencyRate $currenciesExchange): self
    {
        if ($this->currenciesExchange->removeElement($currenciesExchange)) {
            // set the owning side to null (unless already changed)
            if ($currenciesExchange->getCurrencyExchage() === $this) {
                $currenciesExchange->setCurrencyExchage(null);
            }
        }

        return $this;
    }
}
