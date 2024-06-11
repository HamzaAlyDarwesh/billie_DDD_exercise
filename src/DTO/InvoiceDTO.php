<?php

namespace App\DTO;

use App\Domain\Model\Invoice;
use App\Domain\Model\ValueObject\Money;

class InvoiceDTO
{
    public string $id;
    public string $creditorId;
    public string $debtorId;
    public string $amount;
    public bool $isPaid;

    /**
     * @param Invoice $invoice
     */
    public function __construct(public Invoice $invoice)
    {
        $this->id = $invoice->getId();
        $this->creditorId = $invoice->getCreditorId();
        $this->debtorId = $invoice->getDebtorId();
        $this->amount = (string) $invoice->getAmount();
        $this->isPaid = $invoice->isPaid();
    }
}
