<?php

namespace Acme\Product;

class ProductFactory {
    /**
     * @param array{name: string, price: float} $productData
     */
    public static function create(string $code, array $productData): Product {
        return new Product($code, $productData['name'], $productData['price']);
    }
}