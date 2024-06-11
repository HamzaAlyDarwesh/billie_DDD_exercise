<?php

namespace App\Domain\Model;

class Company
{
    /**
     * @param string $id
     * @param string $name
     * @param float $debtorLimit
     */
    public function __construct(private string $id, private string $name, private float $debtorLimit)
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getDebtorLimit(): float
    {
        return $this->debtorLimit;
    }
}
