@deleteRequestOrder
Feature: testing the delete of a purchase invoice

    Scenario: delete a purchase invoice
        Given delete request order data 16
        When "api/request_order_api"
        Then The result will be "excellent"

