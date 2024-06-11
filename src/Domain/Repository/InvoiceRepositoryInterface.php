<?php

namespace App\Domain\Repository;

use App\Domain\Model\Invoice;

interface InvoiceRepositoryInterface
{
    /**
     * @param Invoice $invoice
     * @return void
     */
    public function add(Invoice $invoice): void;

    /**
     * @param string $id
     * @return Invoice|null
     */
    public function findById(string $id): ?Invoice;

    /**
     * @param string $debtorId
     * @return array
     */
    public function findUnpaidByDebtorId(string $debtorId): array;
}