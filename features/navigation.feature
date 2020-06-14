Feature: Navigation

  Rule: Home page is always a single click away from anywhere in the app

    Scenario: Navigating back to the home page
      Given that I navigated away from the home page
      And I am still in the app
      Then I should see a link to the home page

    Scenario: Requesting a page that does not exist
      Given there is a link that does not resolve to a meaningful request
      When I arrive on the 404 page
      Then I should be alerted that the page does not exist
      And I should be redirected to the home page

  Rule : Navigation is forgiving

    Scenario Outline: Requesting existing page with garbled parameters
      Given there is link to the <page> with parameters
      When I misspell that link parameters
      Then I should be silently served the default version of <page>

    Examples:
        | page        |
        | home        |
        | destination |
        | admin       |

# La page administrateur est accessible juste en ajoutant /admin dans l'URL