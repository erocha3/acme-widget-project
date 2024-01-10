<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Acme\Product\Product;

class ProductTest extends TestCase {
    private Product $product;

    protected function setUp(): void {
        parent::setUp();
        $this->product = new Product('R01', 'Red Widget', 32.95);
    }

    public function testGetCode(): void {
        $this->assertEquals('R01', $this->product->getCode());
    }

    public function testGetName(): void {
        $this->assertEquals('Red Widget', $this->product->getName());
    }

    public function testGetPrice(): void {
        $this->assertEquals(32.95, $this->product->getPrice());
    }
}