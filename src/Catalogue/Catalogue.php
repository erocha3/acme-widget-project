<?php

namespace Acme\Catalogue;

use Acme\Config\Config;
use Acme\Product\ProductService;
use Acme\Product\Product;
use Exception;

class Catalogue {
    /** @var array<string, Product> */
    private array $products = [];

    public function __construct(ProductService $productService, string $catalogueName = 'default') {
        $productCodes = (is_array($catalogueData = Config::getInstance()->get('catalogues')) ? $catalogueData[$catalogueName] : []) ?? [];

        if (!is_array($productCodes)) {
            throw new \Exception('Invalid product codes');
        }

        foreach ($productCodes as $code) {
            if (!is_string($code)) {
                throw new \Exception('Invalid product code');
            }

            $product = $productService->getProduct($code);
            if ($product !== null) {
                $this->products[(string)$code] = $product;
            }
        }
    }

    public function getProduct(string $code): ?Product {
        return $this->products[$code] ?? null;
    }

    /**
     * @return array<string, Product>
     */
    public function getAllProducts(): array {
        return $this->products;
    }
}