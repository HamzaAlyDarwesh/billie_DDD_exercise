<?php

require 'vendor/autoload.php';

use App\Infrastructure\Persistence\InMemory\InMemoryCompanyRepositoryInterface;
use App\Infrastructure\Persistence\InMemory\InMemoryInvoiceRepositoryInterface;
use App\Application\Service\CompanyApplicationService;
use App\Application\Service\InvoiceApplicationService;

$companyRepository = new InMemoryCompanyRepositoryInterface();
$invoiceRepository = new InMemoryInvoiceRepositoryInterface();

$companyService = new CompanyApplicationService($companyRepository);
$invoiceService = new InvoiceApplicationService($invoiceRepository, $companyRepository);

return [
    'companyService' => $companyService,
    'invoiceService' => $invoiceService
];
