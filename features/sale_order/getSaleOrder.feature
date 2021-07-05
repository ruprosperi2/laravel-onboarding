Feature: 
	In order to get the sale orders in the CRUD API
@show
Scenario: Show the sale orders
    Given I get to "api/sale_order"
    Then the response code is 200
        And count at least 1 sale order
