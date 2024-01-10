<?php

// This configuration file is a placeholder for demonstration purposes.
// In a production environment, this data would typically be stored in a database.
// The structure and keys used here are designed to mimic the schema and relationships
// that would be present in a robust database.

return [
    // Product data: In a database, this would be a 'products' table.
    'products' => [
        'R01' => ['name' => 'Red Widget', 'price' => 32.95],
        'G01' => ['name' => 'Green Widget', 'price' => 24.95],
        'B01' => ['name' => 'Blue Widget', 'price' => 7.95],
        // ... other products ...
    ],
    
    // Catalogue data: Represents a list of product codes available for sale.
    // In a database, this might be a 'catalogues' table with a many-to-many relationship to 'products'.
    'catalogues' => [
        'default' => ['R01', 'G01', 'B01'],
        // ... other catalogues ...
    ],
    
    // Delivery rules: In a database, this could be a 'delivery_rules' table.
    // Each rule might have a minimum threshold and a corresponding delivery cost.
    'delivery' => [
        ['threshold' => 90, 'cost' => 0.00], // Free delivery for orders $90 or more
        ['threshold' => 50, 'cost' => 2.95], // $2.95 delivery charge for orders from $50 to $89.99
        ['threshold' => 0, 'cost' => 4.95],  // $4.95 delivery charge for orders under $50
    ],
    
    // Special offers: In a database, this might be an 'offers' table with various columns for offer types and conditions.
    'offers' => [
        [
            'type' => 'buy_one_get_one_half_price',
            'qualifying_product' => 'R01',
            'discounted_product' => 'R01',
            'discount_rate' => 0.5,
            'active' => true,
        ],
        // ... other offers ...
    ],
];