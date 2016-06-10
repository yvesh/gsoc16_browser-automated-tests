<?php
namespace Step\Acceptance\Administrator;

class User extends \AcceptanceTester
{
	/**
	 * @Given I am registered administrator named :arg1
	 */
	public function iAmRegisteredAdministratorNamed($arg1)
	{
		$I = $this;
		$I->comment('@todo');
	}

	/**
	 * @Then I should see administrator dashboard
	 */
	public function iShouldSeeAdministratorDashboard()
	{
		$I = $this;
		$I->comment('@todo');
	}

	/**
	 * @Given I am signed in in the administrator area
	 */
	public function iAmSignedInInTheAdministratorArea()
	{
		$I = $this;
		$I->amOnPage('administrator/');
		$I->fillField(['css' => 'input[data-tests="username"]'], 'admin');
		$I->fillField(['css' => 'input[data-tests="password"]'], 'admin');
		$I->click(['css' => 'button[data-tests="log in"]']);
	}
}