<?php
namespace MiniStore\Modules\Orders;

use MiniStore\Modules\Products\Product;
use MiniStore\Modules\Users\Customer;

final class Order
{
    private string $id;
    private Customer $customer;
    private array $products;
    private float $total;
    private string $status;

    public function __construct(string $id, Customer $customer)
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->products = [];
        $this->total = 0;
        $this->status = 'pending';
    }

    public function addProduct(Product $product, int $quantity): void
    {
        $product->decreaseStock($quantity);
        $this->products[] = [
            'product' => $product,
            'quantity' => $quantity,
            'subtotal' => $product->getPrice() * $quantity
        ];
        $this->calculateTotal();
    }

    private function calculateTotal(): void
    {
        $this->total = array_reduce($this->products, fn($sum, $item) => $sum + $item['subtotal'], 0);
    }

    // Getters
    public function getId(): string { return $this->id; }
    public function getCustomer(): Customer { return $this->customer; }
    public function getProducts(): array { return $this->products; }
    public function getTotal(): float { return $this->total; }
    public function getStatus(): string { return $this->status; }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}