Feature: testing the creation of a purchase invoices
@createPurchaseInvoice
Scenario: create a purchase invoices
    Given The request body:
    """
    {
    "supplier": "Casa Thiago",
    "pay_term": "Pagar antes de la fecha de vencimiento",
    "date": "2021-05-01",
    "created": "Annelys",
    "status": "P",
    "observations": "en proceso",
    "items" : [
        {
            "name": "purina para patos",
            "amount": 5,
            "price": 2000,
            "subtotal": 10000
        },

        {
            "name": "Perrarina para ratones",
            "amount": 4,
            "price": 2000,
            "subtotal": 8000
        },

        {
            "name": "harina para gusanos",
            "amount": 5,
            "price": 2000,
            "subtotal": 10000
        }
    ]
}
    """
    When I post to "/api/invoices"
    Then the response reason is "OK"
