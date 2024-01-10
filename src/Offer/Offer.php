<?php

namespace Acme\Offer;

use Acme\Basket\BasketItem;
use InvalidArgumentException;

abstract class Offer implements OfferInterface {
    private string $type;
    private string $qualifyingProduct;
    private string $discountedProduct;
    private float $discountRate;
    private bool $active;

    public function __construct(
        string $type,
        string $qualifyingProduct,
        string $discountedProduct,
        float $discountRate,
        bool $active
    ) {
        $this->type = $type;
        $this->qualifyingProduct = $qualifyingProduct;
        $this->discountedProduct = $discountedProduct;
        $this->discountRate = $discountRate;
        $this->active = $active;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getQualifyingProduct(): string {
        return $this->qualifyingProduct;
    }

    public function getDiscountedProduct(): string {
        return $this->discountedProduct;
    }

    public function getDiscountRate(): float {
        return $this->discountRate;
    }

    public function isActive(): bool {
        return $this->active;
    }

    /**
     * @param array<string, BasketItem> $items
     */
    abstract public function apply(float $total, array $items): float;
}