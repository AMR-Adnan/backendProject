<?php
require __DIR__ . '/../../vendor/autoload.php';

use MiniStore\Modules\Products\Product;
use MiniStore\Modules\Users\Customer;
use MiniStore\Modules\Orders\Order;
use MiniStore\Modules\Payments\PayPal;
use MiniStore\Modules\Payments\CreditCard;
use MiniStore\Traits\Logger;
use MiniStore\Traits\Discountable;
use MiniStore\Traits\Taxable;

// Load configuration
$config = include __DIR__ . '/../../config/config.php';

class OrderProcessor
{
    use Logger, Discountable, Taxable;

    public function processOrder(Order $order, \MiniStore\Modules\Payments\PaymentGateway $payment): void
    {
        $this->log("Processing order #{$order->getId()}");

        // Apply discount
        $subtotal = $order->getTotal();
        $discounted = $this->applyDiscount($subtotal, $config['discount_percentage']);
        
        // Apply tax
        $total = $this->applyTax($discounted, $config['tax_rate']);

        // Process payment
        if ($payment->processPayment($total)) {
            $order->setStatus('paid');
            $this->log("Payment processed successfully for order #{$order->getId()}");
            $this->log("Payment details: " . json_encode($payment->getPaymentDetails()));
        } else {
            $order->setStatus('failed');
            $this->log("Payment failed for order #{$order->getId()}", 'ERROR');
        }
    }
}

// Create products
$products = [
    new Product('p1', 'Laptop', 3000, 10, 'High performance laptop'),
    new Product('p2', 'Phone', 2000, 15, 'Latest smartphone'),
    new Product('p3', 'Headphones', 500, 20, 'Noise cancelling')
];

// Create customer
$customer = new Customer('c1', 'Ahmed Mohammed', 'ahmed@example.com', '123 Main St, Riyadh');

// Create order
$order = new Order('o1', $customer);
$order->addProduct($products[0], 1); // Laptop
$order->addProduct($products[2], 2); // 2 Headphones

// Process payment
$payment = new CreditCard('4111111111111111', '12/25');
$processor = new OrderProcessor();
$processor->processOrder($order, $payment);

// Display results
echo "Order #{$order->getId()} Status: {$order->getStatus()}\n";
echo "Customer: {$customer->getName()}\n";
echo "Total: {$config['currency']} {$order->getTotal()}\n";
echo "Products:\n";
foreach ($order->getProducts() as $item) {
    echo "- {$item['product']->getName()} x{$item['quantity']}: {$config['currency']} {$item['subtotal']}\n";
}