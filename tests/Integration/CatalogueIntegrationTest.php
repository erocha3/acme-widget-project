<?php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use Acme\Catalogue\Catalogue;
use Acme\Product\ProductService;

class CatalogueIntegrationTest extends TestCase {
    private Catalogue $catalogue;
    private ProductService $productService;

    protected function setUp(): void {
        parent::setUp();
        // Instantiate the ProductService
        $this->productService = new ProductService();

        // Create a Catalogue instance with ProductService as dependency
        $this->catalogue = new Catalogue($this->productService);
    }

    public function testGetProduct(): void {
        $product = $this->catalogue->getProduct('R01');
        $this->assertNotNull($product);
        $this->assertEquals('Red Widget', $product->getName());
    }

    public function testGetAllProducts(): void {
        $products = $this->catalogue->getAllProducts();
        $this->assertIsArray($products);
        $this->assertNotEmpty($products);
    }
}