Feature: Tour operator list
      In order to book a trip with a tour operator for a destination
      As a User
      I need to be able to see and compare tour operator offerings

  Rule: Each destination has its own tour operator list page

    Background:
      Given I selected a destination
      Given there are tour operator offerings for that destination

    Scenario: Comparing tour operator offerings
      When I am on the tour operator list page for that destination
      Then I should see a list of avalaible tour operator offerings
      And I should see a price for each tour operator offering
      And I should see a grade for each tour operator offering
      And I should see reviews for each tour operator offering

    Scenario: Booking a trip with a premium tour operator
      Given there are tour operators tagged as premium
      When I click on a premium tour operator name
      Then I should be taken to the tour operator official website
    
    Scenario: Leaving a review
      Given I have something to say about an offering
      When I select an offering review field
      Then I should be able to type a review
      And I should be requested to type my name
      And that review should be displayed in the offering

    # Scenario: Leaving a review
    #   Given I am a registered user
    #   And I am logged in
    #   When I select an offering review field
    #   Then I should be able to type a review
    #   And that review should be displayed in the offering

    # Scenario: Grading a tour operator

  Rule: Tour operator list follows responsive web design

    Scenario Outline: Accessing from different platforms
      Given that I use a <platform>
      When I am on a tour operator list page
      Then I should see the list presented for the <presentation> platform

    Examples:
        | platform | presentation |
        | desktop  | desktop      |
        | laptop   | desktop      |
        | tablet   | mobile       |
        | mobile   | mobile       |
