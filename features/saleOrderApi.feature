Feature: 
	Testing the api CRUD for sale orders
Scenario: Create a sale order
		Given The request body is:
			"""
		{
    		"client": "Cofer",
    		"payment_term" : "Lorem ipsu",
    		"creation_date" : "2021-05-06",
    		"created_by" : "testing",
    		"state" : "active",
    		"observation" : "ipsu lorem",
    		"items" : [
        		{
            		"name" : "desk",
            		"amount" : 1,
            		"price" : 300,
            		"sub_total" : 300
            	},
            	{
            		"name" : "notebook",
            		"amount" : 1,
            		"price" : 1500,
            		"sub_total" : 1500
        		}
            ]
        }
        	"""
        When I post to "api/sale_order"
        Then the response code is 200

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

Scenario: Delete a sale order
	Given the delete id is 1
    Then I want to delete on "api/sale_order/"