Feature: Destination list
    In order to compare tour operator offerings for a destination
    As a customer
    I need to be able to see available destinations

    Rules:
    - Destination list is available on the home page
    - Destination list is always a single click away from anywhere in the app
    - Destination list follows responsive web design

    Scenario: Requesting the homepage
        Given there is a request for the home page
        When I arrive on the home page
        Then I should see the list of available destinations

    Scenario: Requesting the home page with garbled parameters
        Given there is link to the homepage with parameters
        When I misspell that link parameters
        Then I should be silently redirected to the default home page

    Scenario: Requesting a page that does not exist
        Given there is a link that does not resolve to a meaningful request
        When I arrive on the 404 page
        Then I should be alerted that the page does not exist
        And I should be redirected to the home page
    
    Scenario: Navigating back to the home page
        Given that I navigated away from the home page
        And I am still in the app
        Then I should be able navigate back to the home page in a single click
    
    Scenario: Accessing from desktop/laptop
        Given that I use a desktop/laptop computer
        When I arrive on the home page
        Then I should see the list presented for the desktop/laptop platform

    Scenario: Accessing from tablet
        Given that I use a tablet
        When I arrive on the home page
        Then I should see the list presented for the tablet platform

    Scenario: Accessing from mobile
        Given that I use a mobile
        When I arrive on the home page
        Then I should see the list presented for the mobile platform