<?php

namespace Acme\Product;

use Acme\Config\Config;
use InvalidArgumentException;

class ProductService {
    /** @var array<string, mixed> */
    private array $productData;

    public function __construct() {
        $productData = Config::getInstance()->get('products');
        if (!is_array($productData)) {
            throw new InvalidArgumentException('Product data must be an array');
        }
        $this->productData = $productData;
    }

    /**
     * @return array<string, Product>
     */
    public function getAllProducts(): array {
        $products = [];
        foreach ($this->productData as $data) {
            if (!is_array($data) || !isset($data['code']) || !is_string($data['code']) || !isset($data['name']) || !is_string($data['name']) || !isset($data['price']) || !is_float($data['price'])) {
                throw new InvalidArgumentException('Each product must be an array and have a string code, a string name, and a float price');
            }
            $products[$data['code']] = ProductFactory::create($data['code'], $data);
        }
        return $products;
    }
    
    public function getProduct(string $code): ?Product {
        if (!isset($this->productData[$code]) || !is_array($this->productData[$code]) || !isset($this->productData[$code]['name']) || !is_string($this->productData[$code]['name']) || !isset($this->productData[$code]['price']) || !is_float($this->productData[$code]['price'])) {
            throw new InvalidArgumentException('Product data for the given code must be an array and have a string name and a float price');
        }
        return ProductFactory::create($code, $this->productData[$code]);
    }
    
}