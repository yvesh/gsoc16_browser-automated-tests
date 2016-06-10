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
        $this->waitForText('Articles', $this->timeout, ['css' => 'h1']);

        return $this;
    }

    public function searchForArticle($title)
    {
        // TODO Add search etc.
        // ...

        return $this;
    }
}
