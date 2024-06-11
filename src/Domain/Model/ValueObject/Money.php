<?php

namespace App\Domain\Model\ValueObject;

class Money
{
    /**
     * @param float $amount
     * @param string $currency
     */
    public function __construct(private float $amount, private string $currency = 'USD')
    {
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param Money $other
     * @return Money
     */
    public function add(Money $other): Money
    {
        if ($this->currency !== $other->getCurrency()) {
            throw new \InvalidArgumentException('Currency mismatch');
        }
        return new Money($this->amount + $other->getAmount(), $this->currency);
    }

    /**
     * @param Money $other
     * @return bool
     */
    public function isGreaterThan(Money $other): bool
    {
        if ($this->currency !== $other->getCurrency()) {
            throw new \InvalidArgumentException('Currency mismatch');
        }
        return $this->amount > $other->getAmount();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->currency . ' ' . number_format($this->amount, 2);
    }
}
