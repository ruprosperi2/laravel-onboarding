@createRequest
    Feature: I am going to create a request order to test an API.
    Scenario: Create A request order
        Given These are the data of the request order:
			"""
		{
            "date": "2021-07-08",
            "created_by": "Reina",
            "status": "compldetado",
            "observations": "Para defenderse",
            "itemsRequests": [
                {
                    "product_name": "escudos",
                    "amount": "150"
                }
            ]
        }
        	"""
        When I post link "api/request_order_api"
        Then The result will be "excellent"
