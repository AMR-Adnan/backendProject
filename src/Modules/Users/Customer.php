<?php
namespace MiniStore\Modules\Users;

final class Customer extends User
{
    private string $shippingAddress;

    public function __construct(string $id, string $name, string $email, string $shippingAddress)
    {
        parent::__construct($id, $name, $email);
        $this->shippingAddress = $shippingAddress;
    }

    public function getRole(): string { return 'customer'; }
    public function getShippingAddress(): string { return $this->shippingAddress; }
}