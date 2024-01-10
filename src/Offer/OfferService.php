<?php

namespace Acme\Offer;

use Acme\Config\Config;
use InvalidArgumentException;

class OfferService {
    /** @var array<string, mixed> */
    private array $offerData;

    public function __construct() {
        $offerData = Config::getInstance()->get('offers');
        if (!is_array($offerData)) {
            throw new InvalidArgumentException('Offer data must be an array');
        }
        $this->offerData = $offerData;
    }

    /**
     * @return array<OfferInterface>
     */
    public function getAllOffers(): array {
        $offers = [];
        foreach ($this->offerData as $data) {
            /** @var array{type: string, qualifying_product: string, discounted_product: string, discount_rate: float, active: bool} $data */
            $this->validateOfferData($data);
            $offer = OfferFactory::create($data);
            if ($offer !== null) {
                $offers[] = $offer;
            }
        }
        return $offers;
    }

    /**
     * @return array<OfferInterface>
     */
    public function getActiveOffers(): array {
        $offers = [];
        foreach ($this->offerData as $data) {
            /** @var array{type: string, qualifying_product: string, discounted_product: string, discount_rate: float, active: bool} $data */
            $this->validateOfferData($data);
            if ($data['active']) {
                $offer = OfferFactory::create($data);
                if ($offer !== null) {
                    $offers[] = $offer;
                }
            }
        }
        return $offers;
    }

    public function getSpecificOffer(string $type): ?OfferInterface {
        foreach ($this->offerData as $data) {
            /** @var array{type: string, qualifying_product: string, discounted_product: string, discount_rate: float, active: bool} $data */
            $this->validateOfferData($data);
            if ($data['type'] === $type && $data['active']) {
                return OfferFactory::create($data);
            }
        }
        return null;
    }

    /**
     * @param array<string, mixed> $data
     */
    private function validateOfferData(array $data): void {
        if (!isset($data['type'], $data['qualifying_product'], $data['discounted_product'], $data['discount_rate'], $data['active'])
            || !is_string($data['type'])
            || !is_string($data['qualifying_product'])
            || !is_string($data['discounted_product'])
            || !is_float($data['discount_rate'])
            || !is_bool($data['active'])
        ) {
            throw new InvalidArgumentException('Invalid offer data');
        }
    }
}