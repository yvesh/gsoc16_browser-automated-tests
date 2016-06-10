Feature: Administrator articles
  In order to manage articles
  As administrator
  I need to be able to create, edit, publish and delete articles

  Background:
    Given I am logged in the backend as a user with the "super administrator" role

  Scenario: Admin creates an Article
    Given I am on the Article create site
    When I fill in "title" with "My Article"
    And I fill "content" with "My text"
    And I save an article
    Then I should see "Article successfully saved"
