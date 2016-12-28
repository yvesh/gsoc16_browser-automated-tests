<?php
/**
 * Created by PhpStorm.
 * User: g0ne
 * Date: 28/12/2016
 * Time: 10:17
 */

/**
 * Simple test runner for screenshots for the marketing team
 */
class generatorCest
{
	public function _before(GifsTester $I)
	{
	}

	public function _after(GifsTester $I)
	{
	}

	/**
	 * Install Joomla staging
	 *
	 * @param ScreenshotsTester $I
	 */
	public function installationScreenshots(GifsTester $I)
	{
		return;

		$I->comment('I open Joomla Installation Configuration Page');

		$I->installJoomlaRemovingInstallationFolder();
		$I->doAdministratorLogin();
		$I->disableStatistics();
	}

	/**
	 * Custom fields
	 *
	 * @param GifsTester $I
	 */
	public function fieldsGif(GifsTester $I)
	{
		// Preparations
		$I->amOnPage('administrator/');
		$I->doAdministratorLogin();

		$I->wait(6);

		// Start
		$I->comment('START');
		$I->amOnPage('images/start.png');
		$I->wait(4);

		$I->amOnPage('administrator/');

		$I->wait(2);
		$I->click('Content');
		$I->wait(1);
		$I->click('a[href="index.php?option=com_fields&context=com_content.article"]');
		$I->wait(2);
		$I->click('.btn-success');
		$I->wait(2);
		$I->fillField('#jform_title', 'Custom Fields');
		$I->wait(1);
		$I->fillField('#jform_label', '3.7');
		$I->wait(1);
		$I->fillField('#jform_default_value', 'is here!');
		$I->wait(1);
		$I->click('.btn-success');

		$I->comment('END');

		// End
		$I->wait(4);
	}
}
