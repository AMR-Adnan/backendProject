<?php
namespace MiniStore\Traits;

trait Discountable
{
    public function applyDiscount(float $amount, float $discountPercentage): float
    {
        if ($discountPercentage < 0 || $discountPercentage > 1) {
            throw new \InvalidArgumentException("Discount percentage must be between 0 and 1");
        }
        return $amount * (1 - $discountPercentage);
    }
}