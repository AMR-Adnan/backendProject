<?php
namespace MiniStore\Modules\Products;

final class Product
{
    private string $id;
    private string $name;
    private float $price;
    private int $stock;
    private string $description;

    public function __construct(string $id, string $name, float $price, int $stock, string $description = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
        $this->description = $description;
    }

    // Getters with strict type hints
    public function getId(): string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getPrice(): float { return $this->price; }
    public function getStock(): int { return $this->stock; }
    public function getDescription(): string { return $this->description; }

    // Secure stock modification
    public function decreaseStock(int $quantity): void
    {
        if ($quantity <= 0) {
            throw new \InvalidArgumentException("Quantity must be positive");
        }
        if ($this->stock < $quantity) {
            throw new \RuntimeException("Insufficient stock");
        }
        $this->stock -= $quantity;
    }
}