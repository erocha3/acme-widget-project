<?php

namespace Acme\Config;

class Config {
    private static ?Config $instance = null;

    /** @var array<string, mixed> */
    private array $data;

    private function __construct() {
        $this->data = require __DIR__ . '/../../config/data.php';
    }

    public static function getInstance(): Config {
        if (self::$instance === null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    public function get(string $key): mixed {
        return $this->data[$key] ?? null;
    }
}