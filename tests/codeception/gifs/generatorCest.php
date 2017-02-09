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

	const SHORT = 1;
	const NORMAL = 2;
	const LONG = 4;
	const START = 6;

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

		$I->wait(self::START);

		// Start
		$I->comment('START');
		$I->amOnPage('images/custom-fields.png');
		$I->wait(self::LONG);

		$I->amOnPage('administrator/');

		$I->wait(self::NORMAL);
		$I->click('Content');
		$I->wait(self::NORMAL);
		$I->click('a[href="index.php?option=com_fields&context=com_content.article"]');
		$I->wait(self::NORMAL);
		$I->click('.btn-success');
		$I->wait(self::NORMAL);
		$I->fillField('#jform_title', 'Custom Text Field');
		$I->wait(self::SHORT);
		$I->fillField('#jform_label', 'Joomla! 3.7');
		$I->wait(self::SHORT);
		$I->click('.btn-success');
		$I->wait(self::NORMAL);

		$I->amOnPage('administrator/index.php?option=com_content&view=article&layout=edit');
		$I->wait(self::NORMAL);

		$I->fillField('#jform_title', 'Article with Custom field');
		$I->wait(self::NORMAL);


		$I->scrollTo(['css' => 'div.toggle-editor']);
		$I->click('Toggle editor');
		$I->fillField('#jform_articletext', 'A sample article');
		$I->wait(self::NORMAL);

		$I->executeJS('window.scrollTo(0,0);');
		$I->wait(self::SHORT);

		$I->click('a[href="#attrib-fields-0"]');
		$I->wait(self::NORMAL);

		$I->fillField('#jform_params_custom_text_field', 'Joomla');
		$I->wait(self::NORMAL);

		$I->click('.btn-success');

		$I->wait(3);
		$I->amOnPage('images/custom-fields-thankyou.png');

		$I->comment('END');

		// End
		$I->wait(10);
	}
}
