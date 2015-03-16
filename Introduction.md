# Introduction #

We currently have a reference implementation for the backend in the [backend-prototype branch](http://code.google.com/p/uninformed/source/browse/#svn/branches/backend-prototype) that will not be developed further. Based on this reference implementation we are now in the process of implementing the a final version of the backend and frontend. During planning we had to address the fact that we weren't sure how many development resources we have available. So we created plan A and plan B in order to be able to provide a fully working solution either way:

  * Plan A: In plan A the idea is that all data entry will be done via the backend web interface. There will be a way to import excel sheets solely for the purpose of being able to import legacy data files.
  * Plan B: In plan B the idea is that all data entry will be done via the backend web interface that cannot be done via the excel sheet format in a sensible way.

The following specification just details the functional delta between the current backend prototype and the final planned version. All features which are required for plan B will be noted as such. Due to resource constraints we ended up going with Plan B.

## General requirements ##

It needs to be possible to define what admintools are accessible to what user groups. Further certain actions within admin tools also need to be restrict-able (For example setting a Document to status active should be limited to certain users). Ideally there would be a versioned history of all entities. Ideally there would also be some support tools/filters to aid the editorial process like being able to see a list of items that need review, seeing all items which were created/modified by someone specific etc.

## Frontend Specifications ##

**Search similar to kayak.com (aka some basic search forms lead to a search result with checkboxes and sliders to further tweak the result set)** The pages for clauses and documents should heavily interlink to show the relations between them
**Users should be able to register** Logged in users should be able to bookmark and comment clause and documents

## Backend Specifications ##

  * TagAdmintool
  * OrganisationAdmintool (plan B)
  * Memberstates2OrganisationAdmintool (plan B)
  * DocumentTypeAdmintool
  * ExcelsheetImport (plan B)
  * DocumentAdmintool (plan B, only voting)
  * OperativePhrasesAdmintool
  * InformationTypeAdmintool
  * AddresseeAdmintool
  * ClauseAdmintool