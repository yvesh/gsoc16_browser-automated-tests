# https://github.com/cucumber/cucumber/wiki/Cucumber-Backgrounder
# http://blog.josephwilk.net/ruby/telling-a-good-story-rspec-stories-from-the-trenches.html
Feature: Create an Article

  Background:
    Given I am signed in in the administrator area
    And I am allowed to create an article
    And There is a category

  Scenario: Successfully create an Article

    # Even that could be I create an article with the title "a" and text "b"
    # or Given article

    Given the following article details:
      | Title      | Text    |
      | My Article | My text |
    When I create an article
    Then I should see the article in the overview

    # ...
    # Article not successful etc.