
<?php
/**
 * @package     Joomla
 * @subpackage  tests
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
class ContentCest
{
	public function __construct()
	{
		$this->faker = Faker\Factory::create();
		$this->title = 'Article' . $this->faker->randomNumber();
		$this->text  = $this->faker->text();
	}

	public function administratorCreateArticle(\AcceptanceTester $I)
	{
		$I->am('Administrator');
		$I->wantToTest('Create an article');

		$I->doAdministratorLogin();

		// Could be extended to click from Dashboard..
		$I->amGoingTo('Navigate to Article page in /administrator/');
		$I->amOnPage('administrator/index.php?option=com_content&view=articles');

		$I->waitForText('Articles', '30', ['css' => 'h1']);
		$I->checkForPhpNoticesOrWarnings();

		$I->clickToolbarButton('New');
		$I->waitForText('Articles: New', '30', ['css' => 'h1']);
		$I->expectTo('see Article edit page');
		$I->checkForPhpNoticesOrWarnings();

		$I->amGoingTo('try to save an article with a filled title and description');

		$I->fillField(['id' => 'jform_title'], $this->title);

		// Iframe editor
		$I->switchToIFrame("jform_articletext_ifr");
		$I->fillField(['id' => 'tinymce'], $this->text);

		// Switch back
		$I->switchToIFrame();

		$I->clickToolbarButton('Save & Close');
		$I->waitForText('Articles', '30', ['css' => 'h1']);
		$I->checkForPhpNoticesOrWarnings();

		$I->expectTo('see a success message and the article added after saving the article');
		$I->see('Article successfully saved', ['id' => 'system-message-container']);
	}
}
