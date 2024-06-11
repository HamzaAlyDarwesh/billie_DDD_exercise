<?php

namespace App\Domain\Model;

use App\Domain\Model\ValueObject\Money;

class Invoice
{
    private bool $isPaid = false;

    /**
     * @param string $id
     * @param string $creditorId
     * @param string $debtorId
     * @param Money $amount
     */
    public function __construct(private string $id, private string $creditorId, private string $debtorId, private Money $amount)
    {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCreditorId(): string
    {
        return $this->creditorId;
    }

    /**
     * @return string
     */
    public function getDebtorId(): string
    {
        return $this->debtorId;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }

    /**
     * @return bool
     */
    public function isPaid(): bool
    {
        return $this->isPaid;
    }

    /**
     * @return void
     */
    public function markAsPaid(): void
    {
        $this->isPaid = true;
    }
}
