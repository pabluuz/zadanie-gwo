<?php

namespace Recruitment\Entity;

use InvalidArgumentException;
use Recruitment\Entity\Exception\InvalidUnitPriceException;

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


    public function getUnitPrice(): int
    {
        return $this->unitPrice;
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
}
