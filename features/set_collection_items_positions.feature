Feature: Update collection items' positions while submitting collection form
  As a user
  I should be able to change collection items' order

  @javascript
  Scenario: Open page with form that have sortable collection
    When I open "Sortable Collection Form" page
    Then I should see photo "photo1" at position "1"
    And I should see photo "photo2" at position "2"
    And I should see photo "photo3" at position "3"
    When I move photo from position "3" to position "1"
    And submit the form
    Then I should see photo "photo3" at position "1"
    And I should see photo "photo1" at position "2"
    And I should see photo "photo2" at position "3"
