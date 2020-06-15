Feature: Destination list
      In order to compare tour operator offerings for a destination
      As a User
      I need to be able to see and select from available destinations

  Rule: Destination list is available on the home page

    Scenario: Requesting the homepage
      Given there is a request for the home page
      When I am on the home page
      Then I should see the list of available destinations
      And I should see a thumbnail for each destination
      And I should see the number of offerings for each destination

    Scenario Outline: Selecting a destination
      Given I am on the home page
      When I select a <destination>
      Then I should be taken to the <destination> tour operator list
    Examples:
        | destination |
        | Budapest    |
        | Osaka       |
        | Berlin      |
        | Lyon        |
    
  Rule: Destination list follows responsive web design

    Scenario Outline: Accessing from different platforms
      Given that I use a <platform>
      When I am on the home page
      Then I should see the list presented for the <presentation> platform

    Examples:
        | platform | presentation |
        | desktop  | desktop      |
        | laptop   | desktop      |
        | tablet   | tablet       |
        | mobile   | mobile       |