<?php

namespace Acme\Offer;

use Acme\Offer\OfferTypes\BuyOneGetOneHalfPriceOffer;

class OfferFactory {
    /**
     * @param array{type: string, qualifying_product: string, discounted_product: string, discount_rate: float, active: bool} $offerData
     */
    public static function create(array $offerData): ?OfferInterface {
        switch ($offerData['type']) {
            case 'buy_one_get_one_half_price':
                return new BuyOneGetOneHalfPriceOffer(
                    $offerData['type'],
                    $offerData['qualifying_product'],
                    $offerData['discounted_product'],
                    $offerData['discount_rate'],
                    $offerData['active']
                );
            // Add more cases as needed for other types of offers...
            default:
                return null;
        }
    }
}