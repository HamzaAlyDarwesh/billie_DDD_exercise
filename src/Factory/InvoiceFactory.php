<?php

namespace App\Factory;

use App\Domain\Model\Invoice;
use App\Domain\Model\ValueObject\Money;

class InvoiceFactory
{
    /**
     * @param string $id
     * @param string $creditorId
     * @param string $debtorId
     * @param Money $amount
     * @return Invoice
     */
    public static function create(string $id, string $creditorId, string $debtorId, Money $amount): Invoice
    {
        return new Invoice($id, $creditorId, $debtorId, $amount);
    }
}
