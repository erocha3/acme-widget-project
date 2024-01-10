<?php

namespace Acme\Basket;

use Acme\Catalogue\Catalogue;
use Acme\Delivery\DeliveryCalculator;
use Acme\Offer\OfferService;
use Acme\Basket\BasketItem;

class Basket {
    private Catalogue $catalogue;
    private DeliveryCalculator $deliveryCalculator;
    private OfferService $offerService;
    
    /** @var array<string, BasketItem> */
    private array $items = [];

    public function __construct(Catalogue $catalogue, DeliveryCalculator $deliveryCalculator, OfferService $offerService) {
        $this->catalogue = $catalogue;
        $this->deliveryCalculator = $deliveryCalculator;
        $this->offerService = $offerService;
    }

    public function addProduct(string $code): void {
        $product = $this->catalogue->getProduct($code);
        if (!$product) {
            throw new \Exception("Product code does not exist in the catalogue.");
        }
        if (!isset($this->items[$code])) {
            $this->items[$code] = new BasketItem($product, 0);
        }
        $this->items[$code]->incrementQuantity();
    }

    public function getTotal(): float {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item->getProduct()->getPrice() * $item->getQuantity();
            $total = round($total, 2, PHP_ROUND_HALF_EVEN);
        }

        // Apply offers before calculating delivery
        $offers = $this->offerService->getActiveOffers();
        foreach ($offers as $offer) {
            $total = $offer->apply($total, $this->items);
            $total = round($total, 2, PHP_ROUND_HALF_EVEN);
        }

        // Calculate delivery costs based on the total after offers
        $total += $this->deliveryCalculator->calculateDelivery($total);
        $total = round($total, 2, PHP_ROUND_HALF_EVEN);

        return $total;
    }
}