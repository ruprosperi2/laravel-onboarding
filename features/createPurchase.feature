Feature: create
    To make a purchase order
    As a user with permissions,
    I need to be able to place a new order and its items

    Scenario: create purchase order
        Given I have data to carry out the order
        When The user enters the information
        And press send
        Then send "successfully created" message






