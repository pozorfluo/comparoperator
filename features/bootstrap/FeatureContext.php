<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        
    }
        /**
     * @Given there is a request for the home page
     */
    public function thereIsARequestForTheHomePage()
    {
        throw new PendingException();
    }

    /**
     * @When I arrive on the home page
     */
    public function iArriveOnTheHomePage()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see the list of available destinations
     */
    public function iShouldSeeTheListOfAvailableDestinations()
    {
        throw new PendingException();
    }

    /**
     * @Given there is link to the homepage with parameters
     */
    public function thereIsLinkToTheHomepageWithParameters()
    {
        throw new PendingException();
    }

    /**
     * @When I misspell that link parameters
     */
    public function iMisspellThatLinkParameters()
    {
        throw new PendingException();
    }

    /**
     * @Then I should be silently redirected to the default home page
     */
    public function iShouldBeSilentlyRedirectedToTheDefaultHomePage()
    {
        throw new PendingException();
    }

    /**
     * @Given there is a link that does not resolve to a meaningful request
     */
    public function thereIsALinkThatDoesNotResolveToAMeaningfulRequest()
    {
        throw new PendingException();
    }

    /**
     * @When I arrive on the :arg1 page
     */
    public function iArriveOnThePage($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should be alerted that the page does not exist
     */
    public function iShouldBeAlertedThatThePageDoesNotExist()
    {
        throw new PendingException();
    }

    /**
     * @Then I should be redirected to the home page
     */
    public function iShouldBeRedirectedToTheHomePage()
    {
        throw new PendingException();
    }

    /**
     * @Given that I navigated away from the home page
     */
    public function thatINavigatedAwayFromTheHomePage()
    {
        throw new PendingException();
    }

    /**
     * @Given I am still in the app
     */
    public function iAmStillInTheApp()
    {
        throw new PendingException();
    }

    /**
     * @Then I should be able navigate back to the home page in a single click
     */
    public function iShouldBeAbleNavigateBackToTheHomePageInASingleClick()
    {
        throw new PendingException();
    }

    /**
     * @Given that I use a desktop\/laptop computer
     */
    public function thatIUseADesktopLaptopComputer()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see the list presented for the desktop\/laptop platform
     */
    public function iShouldSeeTheListPresentedForTheDesktopLaptopPlatform()
    {
        throw new PendingException();
    }

    /**
     * @Given that I use a tablet
     */
    public function thatIUseATablet()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see the list presented for the tablet platform
     */
    public function iShouldSeeTheListPresentedForTheTabletPlatform()
    {
        throw new PendingException();
    }

    /**
     * @Given that I use a mobile
     */
    public function thatIUseAMobile()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see the list presented for the mobile platform
     */
    public function iShouldSeeTheListPresentedForTheMobilePlatform()
    {
        throw new PendingException();
    }
}
