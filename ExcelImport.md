This page provides information about the Excel document structure and its relation to the model in the database. I will inform about important relations of columns to features and requirements necessary to implement.

# Introduction #

The excel files contain of three tabs, of which we use currently only the first tab "Tags". It contains a list of documents regarding a specific subject, e.g. "Water". The columns are grouped by document information, clause information and tag information.

# Details #

Right now we are trying to understand the working of special columns regarding document and clause relations (documents replacing other documents and some or all of their clauses):

Document A with Clauses 1 and 2.

Document B with Clauses 3, 4 and 5

"Document B replaces Document A in the way that: Clause 3 replaces Clause 2, Clause 5 is new/added and Clause 1 is removed."

Looking at the Excelsheet (water-almost.final.xls) you have sent on Januar, 6th, we see the following columns for documents and clauses:

(Document)
"Part of direct followup (y/n)"
"If part (y): Code of following document"

(Clause)
"Has/is direct follow up (clause specific)"
"Has parent clause (y/n)"
"If parent: Number of parent clause"
"Is a parent clause"

I guess they are related to the concept described before with Document A and Document B. I will now try to take a practical example from the water Excel to see how this works:

Code of document: A/Res/56/192 (International Year of Freshwater)

This document has a follow-up, as noted in the columns "part of direct followup" and "Code of following document"

It has three clauses (2, 3, 4) and all of them have direct follow-ups (clauses) in the follow-up document, see "Has/is direct follow up (clause specific!)" and "Is a parent clause", both of them say "yes" for all three clauses.


We then look into the follow-up document A/Res/57/252, going directly to its clauses. It has six (2, 3, 4, 5, 6, 7) of which three have parent clauses, actually the three clauses from the "parent(?)" document (A/Res/56/192). From the example given above I would make the following conclusion:

A/Res/56/192 with clauses 2, 3 and 4

A/Res/57/252 with clauses 2, 3, 4, 5, 6, 7

"Document A/Res/57/252 replaces A/Res/56/192 in the way that (taken from the column "Has a parent clause: clause number of parent clause"): Clause 252:3 replaces 192:2, Clause 252:4 replaces 192:3 and Clause 252:7 replaces 192:4; Clauses 252:2, 252:5 and 252:6 are added.