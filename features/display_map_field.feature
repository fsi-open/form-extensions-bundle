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

  @javascript
  Scenario: Set fields value when point selected on map
    When I open "One Map Form" page
    And Click on map at position: 50.062/19.937
    Then position fields shoud have values:
      | Field     | Value  |
      | Latitude  | 50.062 |
      | Longitude | 19.937 |

  @javascript
  Scenario: Set map location when field values are changed
    When I open "One Map Form" page
    And fill position fields:
      | Field     | Value  |
      | Latitude  | 50.062 |
      | Longitude | 19.937 |
    Then map position should be 50.062/19.937
