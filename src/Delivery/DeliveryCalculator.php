<?php

namespace Acme\Delivery;

use Acme\Config\Config;

class DeliveryCalculator {
    /** @var array<string, array{threshold: float, cost: float}> */
    private array $deliveryData;

    public function __construct() {
        $this->deliveryData = is_array($deliveryData = Config::getInstance()->get('delivery')) ? $deliveryData : [];
    }

    public function calculateDelivery(float $total): float {
        // Sort the delivery data by threshold descending
        usort($this->deliveryData, function ($a, $b) {
            return $b['threshold'] <=> $a['threshold'];
        });

        // Iterate over the sorted delivery data to find the correct cost
        foreach ($this->deliveryData as $delivery) {
            if ($total >= $delivery['threshold']) {
                return $delivery['cost'];
            }
        }

        $lastDelivery = end($this->deliveryData);
        return $lastDelivery !== false ? $lastDelivery['cost'] : 0.0;
    }
}