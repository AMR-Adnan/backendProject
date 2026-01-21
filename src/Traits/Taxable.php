<?php
namespace MiniStore\Traits;

trait Taxable
{
    public function applyTax(float $amount, float $taxRate): float
    {
        if ($taxRate < 0) {
            throw new \InvalidArgumentException("Tax rate cannot be negative");
        }
        return $amount * (1 + $taxRate);
    }
}