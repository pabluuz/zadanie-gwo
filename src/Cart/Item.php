<?php

namespace Recruitment\Cart;

use InvalidArgumentException;
use Recruitment\Cart\Exception\QuantityTooLowException;
use Recruitment\Entity\Product;

/**
 * Item means single position in cart
 */
class Item
{
    /**
     * @var int $quantity
     */
    private $quantity;

    /**
     * @var Product $product
     */
    private $product;

    /**
     * @param int $quantity
     * @param Product $product
     */
    public function __construct(Product $product, int $quantity)
    {
        if (!$this->isProductQuantitySufficient($product, $quantity)) {
            throw new InvalidArgumentException;
        }
        $this->quantity = $quantity;
        $this->product = $product;
    }


    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): Item
    {
        $this->product = $product;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @throws QuantityTooLowException
     */
    public function setQuantity(int $quantity): Item
    {
        if (!$this->isProductQuantitySufficient($this->getProduct(), $quantity)) {
            throw new QuantityTooLowException();
        }
        $this->quantity = $quantity;

        return $this;
    }

    public function getTotalPrice(): int
    {
        return $this->getQuantity() * $this->getProduct()->getUnitPrice();
    }

    private function isProductQuantitySufficient(Product $product, int $quantity): bool
    {
        return $quantity >= $product->getMinimumQuantity();
    }
}
