# Introduction #

The document type admintool will manage document types.  Its assumed a full list of relevant legal values is available inside the database (no specific admintool).

# Details #

  * List of all existing document types with edit/delete buttons along with a count of how often the phrase is currently used
  * Search filters with livesearch for clauses/documents
  * A separate "quick jump" livesearch form to directly jump to the edit page of that document type entry
  * Button to create a new document type
  * Store a name, an integer "rank" value as well as a legal value (select box)
  * In the edit panel consider adding a tool to migrate the document type setting of clauses to an another/new document type (needs to also work when we have a large number of clauses).