# https://github.com/cucumber/cucumber/wiki/Cucumber-Backgrounder
Feature: Administrator articles
  In order to manage articles
  As administrator
  I need to be able to create, edit, publish and delete articles

  Scenario: Admin creates an Article
    Given I am logged in the backend
    # Even that could be I create an article with the title "a" and text "b"
    When I create an article:
      | title   | My Article |
      | content | My text    |
    Then the article should be saved
