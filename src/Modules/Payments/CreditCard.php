<?php
namespace MiniStore\Modules\Payments;

final class CreditCard implements PaymentGateway
{
    private string $cardNumber;
    private string $expiry;
    private string $transactionId;

    public function __construct(string $cardNumber, string $expiry)
    {
        $this->cardNumber = $cardNumber;
        $this->expiry = $expiry;
    }

    public function processPayment(float $amount): bool
    {
        // Simulate payment processing
        $this->transactionId = uniqid('cc_');
        return true;
    }

    public function getPaymentDetails(): array
    {
        return [
            'gateway' => 'CreditCard',
            'masked_card' => '****' . substr($this->cardNumber, -4),
            'transaction_id' => $this->transactionId
        ];
    }
}