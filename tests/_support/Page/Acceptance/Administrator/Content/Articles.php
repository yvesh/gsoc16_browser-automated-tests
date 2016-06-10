<?php

namespace Page\Acceptance\Administrator\Content;

class Articles extends \AcceptanceTester
{
    protected $selectors = [
        'list' => ['id' => 'articleList'],
    ];

    public function open()
    {
        $this->amOnPage('administrator/index.php?option=com_content&view=articles');

        // We need better selectors
        $this->waitForText('Articles', '30', ['css' => 'h1']);

        return $this;
    }

    public function searchForArticle($title)
    {
        $I = $this;

        // TODO Add search etc.
        // ...

        $I->expectTo('see the Article in the List of Articles');
        $I->see($title, $I->selectors['list']);

        return $this;
    }
}
