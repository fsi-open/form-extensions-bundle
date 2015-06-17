Feature: Display Google map when fsi_map field is used in form
  As a user
  I should see Google map to easier select location.
  After I open page with form that have fsi_map field

  @javascript
  Scenario: Open page with form that have one map field
    When I open "One Map Form" page
    Then I should see form field with label "Map field" that has Google map

  @javascript
  Scenario: Open page with form that have many fsi_ckeditor fields
    When I open "Multiple Map Form" page
    Then I should see form field with label "Map field one" that has Google map
    And I should see form field with label "Map field two" that has Google map
