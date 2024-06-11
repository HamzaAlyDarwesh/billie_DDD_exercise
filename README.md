# billie_ddd_exercise
This is a simple code challenge following DDD (Domain Driven Design) using 
PHP 8.2 version.
# Description

An invoice is a document issued by a seller (creditor) to the buyer (debtor). It provides details
about a sale or service, including the quantities, and costs. Factoring is a process where a company (creditor) sells its invoice to a third-party factoring company (Billie). The factoring company then takes care of collecting the money from the debtor. Since there is always the risk that a debtor won’t pay their invoices, Billie sets a debtor limit for each company. This means that Billie won’t accept the invoice if the debtor’s total amount of open invoices reaches the limit.

# Task
- Create a web service for Billie that allows adding companies, adding invoices, and marking an invoice as paid.
- The code should be easy to run and should include simple documentation to describe the
solution.
- The web service is created using PHP 7 or 8.
- We will look closely at API design and testability.

# How It Works

- Clone this repo.
- Run composer install.
- Run php src/create_company.php to create company.
- Run php src/create_invoice.php to create invoice.
- Run php src/mark_invoice_paid.php to mark invoice as paid.
- Run test vendor/bin/phpunit tests.