# http://docs.behat.org/en/v3.0/guides/1.gherkin.html
Feature: Administrator articles
  In order to manage articles
  As administrator
  I need to be able to create, edit, publish and delete articles

  Scenario: Admin creates an Article
    Given I am logged in the backend as a user with the "super administrator" role
    And I am on "index.php?option=com_content&view=article&layout=edit"
    When I add fill out the "article" form:
      | title   | My Article |
      | content | My text    |
    And click on "Save & Close"
    Then I should see "Article successfully saved"
    And I should see the new article in the list
