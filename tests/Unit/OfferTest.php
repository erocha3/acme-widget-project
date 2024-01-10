<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Acme\Offer\OfferTypes\BuyOneGetOneHalfPriceOffer;
use Acme\Offer\OfferInterface;
use Acme\Basket\BasketItem;
use Acme\Product\Product;

class OfferTest extends TestCase {
    private OfferInterface $offer;

    protected function setUp(): void {
        parent::setUp();
        $offerData = [
            'type' => 'buy_one_get_one_half_price',
            'qualifying_product' => 'R01',
            'discounted_product' => 'R01',
            'discount_rate' => 0.5,
            'active' => true,
        ];
        $this->offer = new BuyOneGetOneHalfPriceOffer(
            $offerData['type'],
            $offerData['qualifying_product'],
            $offerData['discounted_product'],
            $offerData['discount_rate'],
            $offerData['active']
        );
    }

    public function testGetType(): void {
        $this->assertEquals('buy_one_get_one_half_price', $this->offer->getType());
    }

    public function testIsActive(): void {
        $this->assertTrue($this->offer->isActive());
    }

    public function testApply(): void {
        $total = 100.0;
        $items = [
            'R01' => new BasketItem(new Product('R01', 'Red Widget', 32.95), 2)
        ];
        $newTotal = $this->offer->apply($total, $items);

        $this->assertEquals(83.52, $newTotal);
    }
}