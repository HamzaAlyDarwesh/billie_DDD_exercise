<?php

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\Model\Invoice;
use App\Domain\Repository\InvoiceRepositoryInterface;

class InMemoryInvoiceRepositoryInterface implements InvoiceRepositoryInterface
{
    private array $invoices = [];

    public function add(Invoice $invoice): void
    {
        $this->invoices[$invoice->getId()] = $invoice;
    }

    public function findById(string $id): ?Invoice
    {
        return $this->invoices[$id] ?? null;
    }

    public function findUnpaidByDebtorId(string $debtorId): array
    {
        return array_filter($this->invoices, function (Invoice $invoice) use ($debtorId) {
            return $invoice->getDebtorId() === $debtorId && !$invoice->isPaid();
        });
    }
}