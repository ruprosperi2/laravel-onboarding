Feature: testing the delete of a purchase invoice
    @deletePurchaseInvoice
    Scenario: delete a purchase invoice
        Given I want to delete a purchase with id 3
        When you navigate to "api/invoice" with the delete method
        Then the expected response is a "OK"




