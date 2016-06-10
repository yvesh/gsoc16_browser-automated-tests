# http://behat-drupal-extension.readthedocs.io/en/3.1/drupalapi.html
# https://github.com/jhedstrom/drupalextension/tree/master/features
Feature: Administrator articles
  In order to manage articles
  As administrator
  I need to be able to create, edit, publish and delete articles

  Scenario: Admin creates an Article
    Given I am logged in the backend as a user with the "super administrator" role
    When I create an article
    And am on "index.php?option=com_content&view=article&layout=edit"
    And I set the "article" content:
      | title   | My Article |
      | content | My text    |
    And click on "Save"
    Then I should see "Article successfully saved"
