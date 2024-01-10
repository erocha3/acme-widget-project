<?php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use Acme\Basket\Basket;
use Acme\Catalogue\Catalogue;
use Acme\Delivery\DeliveryCalculator;
use Acme\Offer\OfferService;
use Acme\Product\ProductService;

class BasketIntegrationTest extends TestCase {
    private Basket $basket;
    private DeliveryCalculator $deliveryCalculator;
    private OfferService $offerService;
    private ProductService $productService;
    private Catalogue $catalogue;

    protected function setUp(): void {
        parent::setUp();
        // Instantiate the real dependencies
        $this->deliveryCalculator = new DeliveryCalculator();
        $this->productService = new ProductService();
        $this->offerService = new OfferService();
        $this->catalogue = new Catalogue($this->productService);

        // Create a Basket instance with real dependencies
        $this->basket = new Basket($this->catalogue, $this->deliveryCalculator, $this->offerService);
    }

    public function testBasketWithBlueAndGreenWidget(): void {
        $this->basket->addProduct('B01');
        $this->basket->addProduct('G01');
        $this->assertEquals(37.85, $this->basket->getTotal());
    }

    public function testBasketWithTwoRedWidgets(): void {
        $this->basket->addProduct('R01');
        $this->basket->addProduct('R01');
        $this->assertEquals(54.37, $this->basket->getTotal());
    }

    public function testBasketWithRedAndGreenWidget(): void {
        $this->basket->addProduct('R01');
        $this->basket->addProduct('G01');
        $this->assertEquals(60.85, $this->basket->getTotal());
    }

    public function testBasketWithMultipleWidgets(): void {
        $this->basket->addProduct('B01');
        $this->basket->addProduct('B01');
        $this->basket->addProduct('R01');
        $this->basket->addProduct('R01');
        $this->basket->addProduct('R01');
        $this->assertEquals(98.27, $this->basket->getTotal());
    }
}