Feature: testing the update of a purchase invoices
    @updatePurchaseInvoice
    Scenario: update a purchase invoices
        Given The id 1 for update
        And The request body for update:
    """
  {
        "supplier": "Fundacion prosperi",
        "pay_term": "Pagar antes de la fecha actualizada",
        "date": "2021-05-01",
        "created": "Annelys",
        "status": "P",
        "observations": "en proceso",
        "items":[
            {
                "id": 1,
                "name": "chupeta",
                "amount": 10,
                "price": "50.00",
                "subtotal": "500.00",
                "invoice_id": 1
            },

                        {
                "id": 2,
                "name": "doritos",
                "amount": 20,
                "price": "50.00",
                "subtotal": "1000.00",
                "invoice_id": 1
            }

        ]
    }
    """
        When you navigate to "api/invoice" with the put method
        Then the expected response is a code 201
