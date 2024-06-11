<?php

namespace Tests\Application\Service;

use App\Application\Service\InvoiceApplicationService;
use App\Domain\Model\Company;
use App\Infrastructure\Persistence\InMemory\InMemoryCompanyRepositoryInterface;
use App\Infrastructure\Persistence\InMemory\InMemoryInvoiceRepositoryInterface;
use PHPUnit\Framework\TestCase;

class InvoiceApplicationServiceTest extends TestCase
{
    private InvoiceApplicationService $invoiceService;
    private InMemoryCompanyRepositoryInterface $companyRepository;
    private InMemoryInvoiceRepositoryInterface $invoiceRepository;

    protected function setUp(): void
    {
        $this->companyRepository = new InMemoryCompanyRepositoryInterface();
        $this->invoiceRepository = new InMemoryInvoiceRepositoryInterface();
        $this->invoiceService = new InvoiceApplicationService($this->invoiceRepository, $this->companyRepository);
    }

    public function testCreateInvoiceSuccess(): void
    {
        $creditorId = '1';
        $debtorId = '2';
        $amount = 100.0;

        $creditor = new Company($creditorId, 'Creditor Inc.', 0);
        $debtor = new Company($debtorId, 'Debtor Inc.', 1000);

        $this->companyRepository->add($creditor);
        $this->companyRepository->add($debtor);

        $invoiceDTO = $this->invoiceService->createInvoice($creditorId, $debtorId, $amount);

        $this->assertEquals('USD ' . number_format($amount, 2, '.', ''), $invoiceDTO->amount);
        $this->assertEquals($creditorId, $invoiceDTO->creditorId);
        $this->assertEquals($debtorId, $invoiceDTO->debtorId);
    }

    public function testCreateInvoiceDebtorLimitExceeded(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Debtor limit exceeded');

        $creditorId = '1';
        $debtorId = '2';
        $amount = 1500.0;

        $creditor = new Company($creditorId, 'Creditor Inc.', 0);
        $debtor = new Company($debtorId, 'Debtor Inc.', 1000);

        $this->companyRepository->add($creditor);
        $this->companyRepository->add($debtor);

        $this->invoiceService->createInvoice($creditorId, $debtorId, $amount);
    }

    public function testMarkInvoiceAsPaidSuccess(): void
    {
        $creditorId = '1';
        $debtorId = '2';
        $amount = 100.0;

        $creditor = new Company($creditorId, 'Creditor Inc.', 0);
        $debtor = new Company($debtorId, 'Debtor Inc.', 1000);

        $this->companyRepository->add($creditor);
        $this->companyRepository->add($debtor);

        $invoiceDTO = $this->invoiceService->createInvoice($creditorId, $debtorId, $amount);

        $this->invoiceService->markInvoiceAsPaid($invoiceDTO->id);

        $invoice = $this->invoiceRepository->findById($invoiceDTO->id);

        $this->assertTrue($invoice->isPaid());
    }
}
