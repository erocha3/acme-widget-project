# Acme Widget Sales System Project

This project is a proof of concept for a sales system at Acme Widget Co. It's built with PHP 8 and uses object-oriented principles to ensure scalability and flexibility. The project includes a Docker setup for easy development and testing.

## Project Structure

The project is structured into several classes, each with a specific responsibility:

- `Product`: Represents a product with a code, name, and price.
- `Catalogue`: Manages a collection of products.
- `Basket`: Manages a collection of `BasketItem` objects. It is responsible for adding products to the basket, calculating the total cost, and applying any special offers or delivery charges.
- `BasketItem`: Represents an item in the basket, including the product and quantity.
- `OfferService`: Manages a collection of offers. It includes methods to get all offers, get active offers, and get a specific offer. It also validates the offer data.
- `OfferFactory`: Creates an `OfferInterface` object based on the offer type.
- `ProductService`: Manages the product data. It includes methods to get all products and get a specific product. It also validates the product data.
- `ProductFactory`: Creates a `Product` object.

The `Offer` class uses an interface because there could be different types of offers, each with its own way of applying a discount. This design allows for flexibility and scalability as new types of offers can be added in the future without modifying existing code.

## Data Configuration

The `data.php` file is a configuration file that provides data for the project. It includes data for products and offers. In a real-world application, this data would likely come from a database or an external API.

## Docker Setup

The project includes a Dockerfile for setting up a Docker container with PHP 8 and Composer. To build the Docker image and run the container, use the following commands:

```bash
docker build -t acme-widget-project .
docker run acme-widget-project
```

When the Docker container runs, it automatically runs the PHPUnit tests.

## Testing

The project includes unit and integration tests written with PHPUnit. The tests cover the main functionality of the project and serve as proof that the project works as expected.

The main test case for this project is located in the `BasketIntegrationTest` class. This test case provides a comprehensive test of the project's functionality, ensuring that all components work together correctly to calculate the total cost of a basket of products, taking into account special offers and delivery charges.

To run the tests, use the following commands:

```bash
./vendor/bin/phpstan analyse
./vendor/bin/phpunit --configuration phpunit.xml
```

Ensure that all tests pass to verify that the project is working correctly.

## Conclusion

This project demonstrates a scalable and flexible design for a widget management system. By using object-oriented principles and focusing on scalability, the project is designed to handle varying data and to be easily extended with new features in the future.