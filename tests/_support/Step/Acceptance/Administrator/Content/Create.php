<?php

namespace Step\Acceptance\Administrator\Content;

use \Page\Acceptance\Administrator\Content\Article;
use \Page\Acceptance\Administrator\Content\Articles;

class Create extends \AcceptanceTester
{
    protected $article;

    protected $pageArticle;

    protected $pageArticles;

    public function __construct(\Codeception\Scenario $scenario)
    {
        $this->pageArticle = new Article($scenario);
        $this->pageArticles = new Articles($scenario);

        parent::__construct($scenario);
    }

    /**
     * @Given the following article details:
     */
    public function theFollowingArticleDetails(\Behat\Gherkin\Node\TableNode $article)
    {
        $this->article = $article;
    }

    /**
     * @When I create an article
     */
    public function iCreateAnArticle()
    {
        $I = $this;

        $I->pageArticle
            ->open()
            ->createArticle($this->article);
    }

    /**
     * @Then I should see the article in the overview
     */
    public function iShouldSeeTheArticleInTheOverview()
    {
        $I = $this;

        $I->pageArticles
            ->open()
            ->searchForArticle($this->article['title']);

        $I->expectTo('see the Article in the List of Articles');
        $I->see($this->article['title']);
    }

    /**
     * @Given I am allowed to create an article
     */
    public function iAmAllowedToCreateAnArticle()
    {
        $I = $this;

        $I->comment('todo');
    }
}