Feature: 
    In order to edit a sale order in the CRUD API
@edit
Scenario: Edit a sale order
	Given the edit data is:
		"""
	{
    	"client": "testing behat",
    	"payment_term" : "ipsu",
    	"creation_date" : "2021-05-06",
    	"created_by" : "testing",
    	"state" : "active",
    	"observation" : "ipsu",
    	"items" : [
        	{
            	"id": 1,
            	"name" : "testing",
            	"amount" : 1,
            	"price" : 300,
            	"sub_total" : 300,
            	"sale_order_id" : 1
        	},
        	{
            	"id": 2,
            	"name" : "testing",
            	"amount" : 1,
            	"price" : 1500,
            	"sub_total" : 1500,
            	"sale_order_id" : 1
        	}
        ]
    }
    	"""
    When I put to "api/sale_order/1"
    Then the response code is 200
