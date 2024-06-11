<?php

require 'bootstrap.php';

$companyDTO = $companyService->createCompany('Company A', 50000.0);

echo "Created company: " . $companyDTO->name . " with debtor limit: " . $companyDTO->debtorLimit . PHP_EOL;
