<?php

require 'bootstrap.php';


try {
    $invoiceDTO = $invoiceService->createInvoice('1', '2', 1000.0);
    echo "Created invoice: " . $invoiceDTO->id . " with amount: " . $invoiceDTO->amount . PHP_EOL;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
