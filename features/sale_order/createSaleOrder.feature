Feature:
	In order to create a sale order in the CRUD API
@create
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
