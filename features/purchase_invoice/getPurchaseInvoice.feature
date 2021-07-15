Feature: testing the get of a purchase invoice
@getPurchaseInvoice
Scenario: get the first purchase invoice
    Given the id: 1
    When you navigate to "api/invoice"
    Then the expected response is a code 200
        And the response body is a array with a length of at least 1



