<?php

namespace Acme\Offer;

use Acme\Basket\BasketItem;

interface OfferInterface {
    public function getType(): string;
    public function getQualifyingProduct(): string;
    public function getDiscountedProduct(): string;
    public function getDiscountRate(): float;
    public function isActive(): bool;

    /**
     * @param array<string, BasketItem> $items
     */
    public function apply(float $total, array $items): float;
}