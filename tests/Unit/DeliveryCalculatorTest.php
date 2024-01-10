<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Acme\Delivery\DeliveryCalculator;

class DeliveryCalculatorTest extends TestCase {
    private DeliveryCalculator $deliveryCalculator;

    protected function setUp(): void {
        parent::setUp();
        $this->deliveryCalculator = new DeliveryCalculator();
    }

    public function testCalculateDelivery(): void {
        $this->assertEquals(4.95, $this->deliveryCalculator->calculateDelivery(30));
        $this->assertEquals(2.95, $this->deliveryCalculator->calculateDelivery(60));
        $this->assertEquals(0.00, $this->deliveryCalculator->calculateDelivery(100));
    }
}