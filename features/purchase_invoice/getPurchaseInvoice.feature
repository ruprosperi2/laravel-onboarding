Feature: testing the get of a purchase invoice
@getPurchaseInvoice
Scenario: get the first purchase invoice
    Given the id: 1
    When you navigate to "api/invoices"
    Then the response code is 200
        And the body is a JSON array of length 1


