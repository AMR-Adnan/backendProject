<?php
namespace MiniStore\Modules\Payments;

final class PayPal implements PaymentGateway
{
    private string $email;
    private string $transactionId;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function processPayment(float $amount): bool
    {
        // Simulate payment processing
        $this->transactionId = uniqid('paypal_');
        return true;
    }

    public function getPaymentDetails(): array
    {
        return [
            'gateway' => 'PayPal',
            'email' => $this->email,
            'transaction_id' => $this->transactionId
        ];
    }
}