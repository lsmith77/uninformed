# Introduction #

The document admintool will manage both the documents as well as voting and document/clause relations.

## Details ##

  * List of all existing documents with edit/delete buttons
  * Search filters with livesearch for clauses
  * A separate "quick jump" livesearch form to directly jump to the edit page of that document entry
  * Button to create a new document
  * Support for managing document/clause relations (see below)
  * min\_ratification\_count (integer, optional)
  * Flag to mark as ratified
  * Remove preamble
  * Add private/public comment field
  * Add button to send private comment field to a fixed mailinglist
  * Add status field (in draft, active, ready for review, please review)
  * Organisation livesearch should show the full path including parent organisations to deal with ambiguous suborganisation names
  * Document URL should eventually be automatically implied by the document name
  * Add PDF Upload (should eventually attempt to automatically download from the document URL)
  * Make import id non editable and show the name of the excel
  * Support for voting (see below)

## Document relations ##

  * optional followup to a previous document
  * optional document relations (in practice about upto 15)
  * make it possible to specify the type of relation, make possible to create the direction in both direction
  * either select a document in the system or a quick way to create an "in draft" document
    * followup: there can be zero or one
    * recalls: there can be zero or many
    * closely related: there can be zero or many

## Clause relations ##

  * closely related: there can be zero or many
  * optionally make it possible to associate zero or many tags to the relation

## Voting ##

  * legally binding ratification
    * states | signature | ratification | reservations (checkbox)
    * list all states + input text for reservations

  * non-legal binding votes (without a vote)
    * list of states is automatically limited by the organisation id and the adoption date
    * states | yes (default) | no | abstain | not present (radio)