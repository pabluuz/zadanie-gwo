<?php

namespace Recruitment\Entity;

use InvalidArgumentException;
use Recruitment\Entity\Exception\InvalidTaxRateException;
use Recruitment\Entity\Exception\InvalidUnitPriceException;
use Recruitment\Entity\Validator\TaxRateValidator;

class Product
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var int $unitPrice
     */
    private $unitPrice;

    /**
     * @var int $minimumQuantity
     */
    private $minimumQuantity = 1;

    /**
     * @var int $taxRate
     */
    private $taxRate = 0;


    public function getUnitPrice(): int
    {
        return $this->unitPrice;
    }

    /**
     * Important: Take a look at your tax law to check if default rounding works for you.
     * Ie - in Poland we're using default PHP_ROUND_HALF_UP
     */
    public function getGrossUnitPrice(): int
    {
        $unitPrice = $this->getUnitPrice();
        $taxRateMultiplier = $this->getTaxRate()/100;
        return round($unitPrice * $taxRateMultiplier + $unitPrice);
    }

    /**
     * @throws InvalidUnitPriceException
     */
    public function setUnitPrice(int $unitPrice): self
    {
        $this->unitPrice = $unitPrice;
        if ($unitPrice < 1) {
            throw new InvalidUnitPriceException;
        }

        return $this;
    }

    public function getMinimumQuantity(): int
    {
        return $this->minimumQuantity;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setMinimumQuantity(int $minimumQuantity): self
    {
        $this->minimumQuantity = $minimumQuantity;
        if ($minimumQuantity <= 0) {
            throw new InvalidArgumentException;
        }

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTaxRate(): int
    {
        return $this->taxRate;
    }

    public function setTaxRate(int $taxRate): Product
    {
        if (!TaxRateValidator::validateTaxRate($taxRate)) {
            throw new InvalidTaxRateException;
        }
        $this->taxRate = $taxRate;
        return $this;
    }
}
