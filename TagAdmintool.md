# Introduction #

The tag admintool will manage both the tags as well as the implied/recommended related tags.

# Details #

  * List of all existing tags with edit/delete buttons
  * Search filters with livesearch clauses/documents
  * A separate "quick jump" livesearch form to directly jump to the edit page of that tag entry
  * Button to create a new tag
  * Tag has a name and an optional list of implied and recommended related tags
  * Implied and recommended tags search via livesearch, on enter/click the tag relation gets added as plain text with a delete button

adding:
So basically 3 things would be nice: merge/refactor tool, automatically remove document/clause\_body relations when deleting a tag, and adding implied tag support in the document form

## Merge ##
From the tag list, the user can drag and drop a tag into the "merge" field. Adding a second one ore more joins the single tags into one. The order within the "merge" field can be changed by dragging a tag into its desired position.

Alternatively the user can add the desired tags by using the auto complete search field.

## Refactor ##
From the tag list, the user can select a tag he wants to edit. The text will appear in a text input box, where the user can manipulate the tag.
To change "Foo Bar" into "John" and "Doe", he changes "Foo Bar" to "John + Doe" in the text input field. "Foo Bar" is then replaced with "John" and "Doe" is created. Each of them will be skipped when they already exist and related to the documents that had "Foo Bar" before.

We could also have a separate form field with the label "Duplicate relations to" with would support auto suggest, but you can also write in something new.
Then when you hit save it would do renaming if you renamed it in the normal name field
and it would duplicate the relations to either an existing or newly created tag.

Name: John Doe
Duplicate: 
This is in the normal edit form.
So for renaming you do as you always do, you can only duplicate to one tag at a time

## Implied Tags ##
The idea is that when adding new tags its often the case that one tag implies another one, so we should be able to setup the implied tags that when I am tagging a document I can see which tags are implied by the tags that are already selected.

Right now in the document admin the tags are managed via this double link list select widget, but what would be better is that we do not use this widget anymore.

Instead we list each tag with the implied tags next to it as well as a "remove" button
plus a search field to add new tags.

The listed implied tags should be links that when clicked add the given tag