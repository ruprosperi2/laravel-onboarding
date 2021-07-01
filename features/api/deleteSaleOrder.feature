Feature: 
	In order to delete the sale orders in the CRUD API
@delete
Scenario: Delete a sale order
	Given the delete id is 1
    Then I want to delete on "api/sale_order/"