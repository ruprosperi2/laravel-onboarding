Feature: testing the get of all purchase invoices
@getAllPurchaseInvoice
Scenario: get all purchase invoice
    When enter to "api/invoices"
    Then the response code is 200
        And the response reason phrase is “OK”






