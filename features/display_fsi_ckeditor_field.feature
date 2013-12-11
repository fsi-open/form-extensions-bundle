Feature: Display CKEditor when fsi_ckeditor field is used in form
  As a user
  I should see CKEditor instead of textarea
  After I open page with form that have fsi_ckeditor field

  @javascript
  Scenario: Open page with form that have one fsi_ckeditor field
    When I open "One CKEditor Form" page
    Then I should see form field with label "CKEditor field" that is CKEditor
    And "One CKEditor Form" page should have CKEditor included once from "//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.2/ckeditor.js" url

  @javascript
  Scenario: Open page with form that have many fsi_ckeditor fields
    When I open "Multiple CKEditor Form" page
    Then I should see form field with label "CKEditor field one" that is CKEditor
    And I should see form field with label "CKEditor field two" that is CKEditor
    And "Multiple CKEditor Form" page should have CKEditor included once from "//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.2/ckeditor.js" url
