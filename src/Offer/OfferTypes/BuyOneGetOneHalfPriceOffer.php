<?php

namespace Acme\Offer\OfferTypes;

use Acme\Offer\Offer;
use Acme\Basket\BasketItem;

class BuyOneGetOneHalfPriceOffer extends Offer {
    /**
     * Apply the offer to the total.
     *
     * @param float $total The current total.
     * @param BasketItem[] $items An array of BasketItem instances.
     * @return float The new total after the offer has been applied.
     */
    public function apply(float $total, array $items): float {
        $qualifyingProductCode = $this->getQualifyingProduct();

        if (isset($items[$qualifyingProductCode])) {
            $item = $items[$qualifyingProductCode];
            $product = $item->getProduct();
            $quantity = $item->getQuantity();

            if ($quantity > 1) {
                $discount = $this->getDiscountRate() * floor($quantity / 2) * $product->getPrice();
                
                // Round the discount to the nearest cent using "round half to even" behavior
                $discount = round($discount, 2, PHP_ROUND_HALF_EVEN);
                
                $total -= $discount;
            }
        }

        return $total;
    }
}