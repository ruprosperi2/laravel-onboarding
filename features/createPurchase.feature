@create
Feature: create
    To make a purchase order
    As a user with permissions,
    I need to be able to place a new order and its items

    Scenario: create purchase order
        Given I have data to carry out the order:
            """
        {
            "date": "2021-06-26",
            "created_by": "Mauricio",
            "supplier": "Limpiatodo",
            "payment_term": "Sin descuento",
            "status": "entregado",
            "observations": "orden entregada",
            "dataItems": [
                    {
                        "id": 1,
                        "product_name": "KKKKK",
                        "amount": 1,
                        "price": 300,
                        "subtotal": 300
                    },
                    {
                        "id": 2,
                        "product_name": "JJJJJJ",
                        "amount": 1,
                        "price": 1500,
                        "subtotal": 1500
                    },
                    {
                        "id": 3,
                        "product_name": "HHHHHHH",
                        "amount": 1,
                        "price": 1500,
                        "subtotal": 1500
                    }
                        ]
        }
            """

        When The information is sends to "api/Order"
        Then send "successfully created" message






