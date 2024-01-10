<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Acme\Offer\OfferService;

class OfferServiceTest extends TestCase {
    private OfferService $offerService;

    protected function setUp(): void {
        parent::setUp();
        $this->offerService = new OfferService();
    }

    public function testGetActiveOffers(): void {
        $offers = $this->offerService->getActiveOffers();
        $this->assertIsArray($offers);
        $this->assertNotEmpty($offers);
        foreach ($offers as $offer) {
            $this->assertTrue($offer->isActive());
        }
    }

    public function testGetAllOffers(): void {
        $offers = $this->offerService->getAllOffers();
        $this->assertIsArray($offers);
        $this->assertNotEmpty($offers);
    }

    public function testGetSpecificOffer(): void {
        $offer = $this->offerService->getSpecificOffer('buy_one_get_one_half_price');
        $this->assertNotNull($offer);
        $this->assertEquals('buy_one_get_one_half_price', $offer->getType());
    }
}