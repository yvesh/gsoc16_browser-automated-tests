<?php

namespace Page\Acceptance\Administrator\Content;

class Article extends \AcceptanceTester
{
    protected $selectors = [
        'title' => ['id' => 'jform_title'],
        'text' => 'fillTinyMce',

        // For illustration
        'btnSave' => ['xpath' => "//div[@id='toolbar-save']//button"]
    ];


    public function open($id = null)
    {
        $I = $this;

        $url = 'administrator/index.php?option=com_content&view=article&layout=edit';

        if ($id)
        {
            $url .= '&id=' . $id;
        }

        $I->amOnPage($url);

        // We need better selectors
        $I->waitForText($id ? 'Articles: Edit' : 'Articles: New', $this->timeout, ['css' => 'h1']);

        return $this;
    }

    public function createArticle(Array $fields)
    {
        $I = $this;

        foreach ($fields as $key => $value)
        {
            $selector = $this->selectors[strtolower($key)];

            // Check if we have a complex locator
            if (method_exists($this, $selector))
            {
                $this->{$selector}($value);

                continue;
            }

            $I->fillField($selector, $value);
        }

        // Sample
        $I->click($this->selectors['btnSave']);

        return $this;
    }

    protected function fillTinyMce($text)
    {
        $I = $this;

        // Iframe editor
        $I->switchToIFrame("jform_articletext_ifr");
        $I->fillField(['id' => 'tinymce'], $text);

        // Switch back
        $I->switchToIFrame();
    }
}
