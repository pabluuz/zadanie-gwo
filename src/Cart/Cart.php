<?php

namespace Recruitment\Cart;

use OutOfBoundsException;
use Recruitment\Entity\Order;
use Recruitment\Entity\Product;

class Cart
{
    /**
     * @var Item[]
     */
    private $items = [];

    public function getItem(int $index): Item
    {
        if (!array_key_exists($index, $this->items)) {
            throw new OutOfBoundsException();
        }

        return $this->items[$index];
    }

    public function removeProduct(Product $product)
    {
        foreach ($this->getItems() as $key => $item) {
            if ($item->getProduct() === $product) {
                unset($this->items[$key]);
            }
        }
        $this->items = array_values($this->items);
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotalPrice(): int
    {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item->getTotalPrice();
        }
        return $total;
    }

    public function checkout(int $id): Order
    {
        $order = new Order($id);
        $order->setItems($this->items);
        $this->items = [];

        return $order;
    }

    public function setQuantity(Product $product, int $quantity): Cart
    {
        $item = $this->findItemKeyWithProduct($product);
        if ($item === null) {
            $this->addProduct($product, $quantity);
        } else {
            $this->findItemKeyWithProduct($product)->setQuantity($quantity);
        }

        return $this;
    }

    private function findItemKeyWithProduct(Product $product): ?Item
    {
        foreach ($this->getItems() as $item) {
            if ($item->getProduct() === $product) {
                return $item;
            }
        }
        return null;
    }

    public function addProduct(Product $product, int $quantity = 1): Cart
    {
        $foundItem = $this->findItemKeyWithProduct($product);
        if ($foundItem != null) {
            $foundItem->setQuantity($foundItem->getQuantity() + $quantity);

            return $this;
        }
        $item = new Item($product, $quantity);
        $this->items[] = $item;

        return $this;
    }
}
