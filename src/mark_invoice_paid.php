<?php

require 'bootstrap.php';


try {
    $invoiceId = '1'; // replace with the actual invoice ID you want to mark as paid
    $invoiceService->markInvoiceAsPaid($invoiceId);
    echo "Invoice $invoiceId has been marked as paid." . PHP_EOL;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
