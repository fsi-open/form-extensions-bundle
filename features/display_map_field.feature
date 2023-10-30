Feature: Display Google map when fsi_map field is used in form
  As a user
  When I open page with a form that has the fsi_map field
  Then I should be able to use Google maps for easier location selection

  @javascript @google-maps
  Scenario: Opening a page with form that has a single map field
    When I open "One Map Form" page
    Then I should see form field with label "Map field" that has Google map

  @javascript @google-maps
  Scenario: Opening a page with a form that has multiple map fields
    When I open "Multiple Map Form" page
    Then I should see form field with label "Map field one" that has Google map
    And I should see form field with label "Map field two" that has Google map

  @javascript @google-maps
  Scenario: Setting fields' value when a point is selected on the map
    When I open "One Map Form" page
    And click on map at position: 50.062/19.937
    Then position fields shoud have values:
      | Field     | Value  |
      | Latitude  | 50.062 |
      | Longitude | 19.937 |

  @javascript @google-maps
  Scenario: Setting map location when fields' values are changed
    When I open "One Map Form" page
    And fill position fields:
      | Field     | Value  |
      | Latitude  | 50.062 |
      | Longitude | 19.937 |
    Then map position should be set to "50.062" latitude and "19.937" longitude
