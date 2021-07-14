@modifyRequestOrder
    Feature:I am going to change a request order to test an API
    Scenario: Change a request order
    Given These are the data to change of the request order:
	    """
    {
        "date": "2021-07-13",
        "created_by": "gaby",
        "status": "compldetao",
        "observations": "ahora si salio",
        "itemsReq": [
            {
                "id": 26,
                "product_name": "panana",
                "amount": "150",
            "request_id": 16
            }
        ]
    }
        """
        When I put link "api/request_order_api/16"
        Then The result will be "excellent"
