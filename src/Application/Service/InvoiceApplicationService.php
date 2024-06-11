<?php

namespace App\Application\Service;

use App\Domain\Repository\InvoiceRepositoryInterface;
use App\Domain\Repository\CompanyRepositoryInterface;
use App\Factory\InvoiceFactory;
use App\DTO\InvoiceDTO;
use App\Domain\Model\ValueObject\Money;
use Exception;

class InvoiceApplicationService
{
    /**
     * @param InvoiceRepositoryInterface $invoiceRepository
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(private InvoiceRepositoryInterface $invoiceRepository, private CompanyRepositoryInterface $companyRepository)
    {
    }

    /**
     * @param string $creditorId
     * @param string $debtorId
     * @param float $amount
     * @return InvoiceDTO
     * @throws Exception
     */
    public function createInvoice(string $creditorId, string $debtorId, float $amount): InvoiceDTO
    {
        $debtor = $this->companyRepository->findById($debtorId);
        if (!$debtor) {
            throw new Exception("Debtor not found");
        }

        $unpaidInvoices = $this->invoiceRepository->findUnpaidByDebtorId($debtorId);
        $totalUnpaid = array_reduce($unpaidInvoices, fn($sum, $invoice) => $sum + $invoice->getAmount()->getAmount(), 0);

        if ($totalUnpaid + $amount > $debtor->getDebtorLimit()) {
            throw new Exception("Debtor limit exceeded");
        }

        $id = uniqid();
        $money = new Money($amount);
        $invoice = InvoiceFactory::create($id, $creditorId, $debtorId, $money);
        $this->invoiceRepository->add($invoice);

        return new InvoiceDTO($invoice);
    }

    /**
     * @param string $invoiceId
     * @return void
     * @throws Exception
     */
    public function markInvoiceAsPaid(string $invoiceId): void
    {
        $invoice = $this->invoiceRepository->findById($invoiceId);
        if ($invoice) {
            $invoice->markAsPaid();
        } else {
            throw new Exception("Invoice not found");
        }
    }
}