<?php

namespace Recruitment\Entity;

use Recruitment\Cart\Cart;
use Recruitment\Cart\Item;

class Order
{
    /**
     * @var int $id;
     */
    private $id;

    /**
     * @var Item[]
     */
    private $items;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param Item[] $items
     */
    public function setItems(array $items): Order
    {
        $this->items = $items;

        return $this;
    }

    public function getDataForView(): array
    {
        $items = [];
        $total_price = 0;
        foreach ($this->items as $item) {
            $items[] = [
                'id' => $item->getProduct()->getId(),
                'quantity' => $item->getQuantity(),
                'total_price' => $item->getTotalPrice()
            ];
            $total_price += $item->getTotalPrice();
        }
        return [
            'id' => $this->id,
            'items' => $items,
            'total_price' => $total_price
        ];
    }
}
