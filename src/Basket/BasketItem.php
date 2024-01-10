<?php

namespace Acme\Basket;

use Acme\Product\Product;

class BasketItem {
    private Product $product;
    private int $quantity;

    public function __construct(Product $product, int $quantity) {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function incrementQuantity(): void {
        $this->quantity++;
    }
}