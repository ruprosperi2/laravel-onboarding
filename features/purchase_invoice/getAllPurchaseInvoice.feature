Feature: testing the get of all purchase invoices
@getAllPurchaseInvoice
Scenario: get all purchase invoice
    When I post to "api/invoices"
    Then I get to "json"
