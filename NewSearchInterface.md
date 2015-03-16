# Search UI Redesign #

## Backend Test page ##
http://resolutionfinder.org/search/unifiedResults

  * Currently hardcoded to do document searches
  * Filters list numbers for clauses and not for the documents
  * Clause content not yet shown
  * Issues/missing autocomplete
  * Layout incorrect

## Mockup ##
![http://dl.dropbox.com/u/268634/Un-Informed/NewSearchUI.png](http://dl.dropbox.com/u/268634/Un-Informed/NewSearchUI.png)

## Must have ##
  * The dedicated search by code field on the front page disappears and instead the search field is moved into the main form and extended to always also suggest prefix search
  * The radio field to decide if all or any of the tags disappears (only "all tags" from now on supported)
  * The labels are moved into the input fields (shown as grey text that disappears when one clicks into the field)
  * In the tags field when a tag is selected its added as a "separate bubble" into the tags field (see http://code.drewwilson.com/entry/autosuggest-jquery-plugin)
  * On the search result page the input fields are shown at the top, allowing the filters to be moved up
  * In the filters we should for each filter type show at most 5 (configurable for each type) number of filters with a show more to show the rest (handled entirely client side)
  * There is quote-aware (aka `"security co` will be send to the server as one term) autosuggest inside the fulltext search field
  * There is a button to enable help-mode and only in this help mode the ? buttons are shown with links to the help page opening in a new window
  * There are two search buttons: "Search for Clauses" and "Search for Documents"
  * "Search for Documents"
    * Shows the results grouped by Documents
    * Clause content is shown folded if there is nothing highlighted in the content

## Nice to have ##
  * Clause content is reduced to only show with sections containing highlighted text
  * Add a button to generate a short link for the current search results

## API calls ##

### to autocomplete a tag ###

  * url: http://resolutionfinder.org/search/searchTags?term=war
  * example reply:
```
[{"id":"225","label":"war"},{"id":"234","label":"war prevention"}]
```

### to autocomplete a document code ###

  * url: http://resolutionfinder.org/search/searchDocumentCode?term=a/res/40
  * example reply:
```
[{"url":","label":"A\/RES\/40*"}{"url":"\/document\/255-international-drinking-water-s","label":"A\/RES\/40\/171"}]
```

### to autocomplete a fulltext search term ###

  * url: http://resolutionfinder.org/search/searchTerm?term=secr
  * example reply:
```
[{"label":"secretary","count":381},{"label":"secretariat","count":30}]
```

### to execute a document search ###

  * url: http://resolutionfinder.org/search/results?q=africa&t%5B22%5D=medication&dc=&st=document
  * note the `t[22]=medication`, the relevant bit is the 22, which is the id of the tag "medication". the above mentioned jquery autosuggest plugin does not support storing a different key for a tag value out of the box.
  * note filters counts denote the number of clauses matched inside the listed documents
  * example reply:
```
{
  "searchType": "document",
  "data": [
    {
      "id": "25",
      "code": "A/RES/58/237",
      "organisation_id": "2",
      "is_ratified": null,
      "adoption_date": "2003-12-23",
      "slug": "25-2-aa-2-aa-decade-to-roll-back-",
      "DocumentType": {
        "id": "2",
        "name": "GA resolution",
        "legal_value": "non-legally binding"
      },
     "isSCResolution": false,
      "Organisation": {
        "name": "UNO GA"
      },
     "Tags": [
        {
          "id": "15",
          "name": "health care",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "46",
          "name": "roll back malaria (rbm)",
          "highlight": false
        },
       {
          "id": "60",
          "name": "health",
          "highlight": false
        },
       {
          "id": "73",
          "name": "africa",
          "highlight": false
        }
     ],
     "Clauses": [
        {
          "id": "184",
          "document_id": "25",
          "slug": "184-a-res-58-237-7-other-important",
          "clause_number": "7",
          "ClauseBody": {
            "id": "184",
            "root_clause_body_id": null,
            "ClauseInformationType": {
              "id": "4",
              "name": "Other important information"
            }
         },
         "clauseHistory": 0,
          "score": "100.00",
          "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
          "content": "<em>Recognizes</em> the importance of the development of effective vaccines and \nnew medicines to prevent and treat malaria, and the need for further research, including through effective global partnerships such as the various malaria vaccine initiatives and the Medicines for Malaria Venture, in securing their development",
          "Tags": [
            {
              "id": "3",
              "name": "treatment",
              "highlight": false
            },
           {
              "id": "4",
              "name": "prevention",
              "highlight": false
            },
           {
              "id": "22",
              "name": "medication",
              "highlight": true
            },
           {
              "id": "23",
              "name": "malaria",
              "highlight": false
            },
           {
              "id": "39",
              "name": "malaria control",
              "highlight": false
            },
           {
              "id": "50",
              "name": "vaccination",
              "highlight": false
            },
           {
              "id": "65",
              "name": "international cooperation",
              "highlight": false
            }
         ]
       },
       {
          "id": "186",
          "document_id": "25",
          "slug": "186-a-res-58-237-9-request-to-acto",
          "clause_number": "9",
          "ClauseBody": {
            "id": "186",
            "root_clause_body_id": null,
            "ClauseInformationType": {
              "id": "3",
              "name": "Request to actors other than states"
            }
         },
         "clauseHistory": 0,
          "score": "100.00",
          "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
          "content": "<em>Urges</em> the pharmaceutical industry to take note of the increasing need for \neffective combination treatment for malaria, particularly in <strong>Africa</strong>, and to form additional alliances and partnerships to help to ensure that all people at risk have access to prompt, affordable and quality treatment;",
          "Tags": [
            {
              "id": "3",
              "name": "treatment",
              "highlight": false
            },
           {
              "id": "22",
              "name": "medication",
              "highlight": true
            },
           {
              "id": "23",
              "name": "malaria",
              "highlight": false
            },
           {
              "id": "29",
              "name": "combination treatment",
              "highlight": false
            },
           {
              "id": "47",
              "name": "access to treatment",
              "highlight": false
            },
           {
              "id": "57",
              "name": "pharmaceuticals",
              "highlight": false
            },
           {
              "id": "65",
              "name": "international cooperation",
              "highlight": false
            }
         ]
       }
     ],
     "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>"
    },
   {
      "id": "26",
      "code": "A/RES/59/256",
      "organisation_id": "2",
      "is_ratified": null,
      "adoption_date": "2004-12-23",
      "slug": "26-2-aa-2-aa-decade-to-roll-back-",
      "DocumentType": {
        "id": "2",
        "name": "GA resolution",
        "legal_value": "non-legally binding"
      },
     "isSCResolution": false,
      "Organisation": {
        "name": "UNO GA"
      },
     "Tags": [
        {
          "id": "15",
          "name": "health care",
          "highlight": false
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "46",
          "name": "roll back malaria (rbm)",
          "highlight": false
        },
       {
          "id": "60",
          "name": "health",
          "highlight": false
        },
       {
          "id": "73",
          "name": "africa",
          "highlight": false
        }
     ],
     "Clauses": [
        {
          "id": "197",
          "document_id": "26",
          "slug": "197-a-res-59-256-11-commitment-mad",
          "clause_number": "11",
          "ClauseBody": {
            "id": "197",
            "root_clause_body_id": null,
            "ClauseInformationType": {
              "id": "6",
              "name": "Commitment made by states (international action)"
            }
         },
         "clauseHistory": 0,
          "score": "100.00",
          "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
          "content": "<em>Calls upon</em> the international community to support investment in the \ndevelopment of new anti-malarial medicines and insecticides for the effective control of malaria in view of the challenging resistance of the parasite to anti-malarial medicines and the resistance of mosquitoes to insecticides",
          "Tags": [
            {
              "id": "22",
              "name": "medication",
              "highlight": true
            },
           {
              "id": "23",
              "name": "malaria",
              "highlight": false
            },
           {
              "id": "30",
              "name": "insecticide",
              "highlight": false
            },
           {
              "id": "39",
              "name": "malaria control",
              "highlight": false
            },
           {
              "id": "49",
              "name": "research",
              "highlight": false
            },
           {
              "id": "57",
              "name": "pharmaceuticals",
              "highlight": false
            }
         ]
       },
       {
          "id": "195",
          "document_id": "26",
          "slug": "195-a-res-59-256-9-other-important",
          "clause_number": "9",
          "ClauseBody": {
            "id": "195",
            "root_clause_body_id": "184",
            "ClauseInformationType": {
              "id": "4",
              "name": "Other important information"
            }
         },
         "clauseHistory": 0,
          "score": "86.42",
          "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
          "content": "<em>Recognizes</em> the importance of the development of effective vaccines and new medicines to prevent and treat malaria and the need for further and accelerated research, including through effective global partnerships such as the various malaria vaccine initiatives and the Medicines for Malaria Venture, where necessary stimulated by new incentives to secure their development",
          "Tags": [
            {
              "id": "3",
              "name": "treatment",
              "highlight": false
            },
           {
              "id": "4",
              "name": "prevention",
              "highlight": false
            },
           {
              "id": "22",
              "name": "medication",
              "highlight": true
            },
           {
              "id": "23",
              "name": "malaria",
              "highlight": false
            },
           {
              "id": "37",
              "name": "funding",
              "highlight": false
            },
           {
              "id": "39",
              "name": "malaria control",
              "highlight": false
            },
           {
              "id": "50",
              "name": "vaccination",
              "highlight": false
            },
           {
              "id": "65",
              "name": "international cooperation",
              "highlight": false
            }
         ]
       }
     ],
     "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>"
    },
   {
      "id": "27",
      "code": "A/RES/60/221",
      "organisation_id": "2",
      "is_ratified": null,
      "adoption_date": "2005-12-23",
      "slug": "27-2-aa-2-aa-decade-to-roll-back-",
      "DocumentType": {
        "id": "2",
        "name": "GA resolution",
        "legal_value": "non-legally binding"
      },
     "isSCResolution": false,
      "Organisation": {
        "name": "UNO GA"
      },
     "Tags": [
        {
          "id": "15",
          "name": "health care",
          "highlight": false
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "46",
          "name": "roll back malaria (rbm)",
          "highlight": false
        },
       {
          "id": "60",
          "name": "health",
          "highlight": false
        },
       {
          "id": "73",
          "name": "africa",
          "highlight": false
        }
     ],
     "Clauses": [
        {
          "id": "211",
          "document_id": "27",
          "slug": "211-a-res-60-221-13-other-importan",
          "clause_number": "13",
          "ClauseBody": {
            "id": "211",
            "root_clause_body_id": "184",
            "ClauseInformationType": {
              "id": "4",
              "name": "Other important information"
            }
         },
         "clauseHistory": 0,
          "score": "86.42",
          "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
          "content": "<em>Recognizes</em> the importance of the development of effective vaccines and \nnew medicines to prevent and treat malaria and the need for further and accelerated research, including by providing support to the United Nations Childrenâ€™s Fund/United Nations Development Programme/World Bank/World Health Organization Special Programme for Research and Training in Tropical Diseases and through effective global partnerships such as the various malaria vaccine initiatives and the Medicines for Malaria Venture, where necessary stimulated by new incentives to secure their development",
          "Tags": [
            {
              "id": "3",
              "name": "treatment",
              "highlight": false
            },
           {
              "id": "4",
              "name": "prevention",
              "highlight": false
            },
           {
              "id": "22",
              "name": "medication",
              "highlight": true
            },
           {
              "id": "23",
              "name": "malaria",
              "highlight": false
            },
           {
              "id": "37",
              "name": "funding",
              "highlight": false
            },
           {
              "id": "39",
              "name": "malaria control",
              "highlight": false
            },
           {
              "id": "50",
              "name": "vaccination",
              "highlight": false
            },
           {
              "id": "65",
              "name": "international cooperation",
              "highlight": false
            }
         ]
       },
       {
          "id": "212",
          "document_id": "27",
          "slug": "212-a-res-60-221-14-commitment-mad",
          "clause_number": "14",
          "ClauseBody": {
            "id": "212",
            "root_clause_body_id": "197",
            "ClauseInformationType": {
              "id": "6",
              "name": "Commitment made by states (international action)"
            }
         },
         "clauseHistory": 0,
          "score": "86.42",
          "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
          "content": "<em>Calls upon</em> the international community to support investment in the \ndevelopment of new medicines to prevent and treat malaria, especially for children and pregnant women, sensitive and specific diagnostic tests, effective vaccines, and new insecticides and delivery modes in order to enhance effectiveness and delay the onset of resistance, including through existing partnerships",
          "Tags": [
            {
              "id": "3",
              "name": "treatment",
              "highlight": false
            },
           {
              "id": "4",
              "name": "prevention",
              "highlight": false
            },
           {
              "id": "22",
              "name": "medication",
              "highlight": true
            },
           {
              "id": "23",
              "name": "malaria",
              "highlight": false
            },
           {
              "id": "30",
              "name": "insecticide",
              "highlight": false
            },
           {
              "id": "31",
              "name": "pregnancy",
              "highlight": false
            },
           {
              "id": "39",
              "name": "malaria control",
              "highlight": false
            },
           {
              "id": "49",
              "name": "research",
              "highlight": false
            },
           {
              "id": "57",
              "name": "pharmaceuticals",
              "highlight": false
            }
         ]
       }
     ],
     "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>"
    },
   {
      "id": "28",
      "code": "A/RES/61/228",
      "organisation_id": "2",
      "is_ratified": null,
      "adoption_date": "2006-12-22",
      "slug": "28-2-aa-2-aa-decade-to-roll-back-",
      "DocumentType": {
        "id": "2",
        "name": "GA resolution",
        "legal_value": "non-legally binding"
      },
     "isSCResolution": false,
      "Organisation": {
        "name": "UNO GA"
      },
     "Tags": [
        {
          "id": "15",
          "name": "health care",
          "highlight": false
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "46",
          "name": "roll back malaria (rbm)",
          "highlight": false
        },
       {
          "id": "60",
          "name": "health",
          "highlight": false
        },
       {
          "id": "73",
          "name": "africa",
          "highlight": false
        }
     ],
     "Clauses": [
        {
          "id": "228",
          "document_id": "28",
          "slug": "228-a-res-61-228-14-other-importan",
          "clause_number": "14",
          "ClauseBody": {
            "id": "228",
            "root_clause_body_id": "184",
            "ClauseInformationType": {
              "id": "4",
              "name": "Other important information"
            }
         },
         "clauseHistory": 0,
          "score": "86.42",
          "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
          "content": "<em>Recognizes</em> the importance of the development of safe and cost-effective \nvaccines and new medicines to prevent and treat malaria and the need for further and accelerated research, including into safe, effective and high-quality traditional therapies, using rigorous standards, including by providing support to the Special Programme for Research and Training in Tropical Diseases and through effective global partnerships such as the various malaria vaccine initiatives and the Medicines for Malaria Venture, where necessary stimulated by new incentives to secure their development",
          "Tags": [
            {
              "id": "3",
              "name": "treatment",
              "highlight": false
            },
           {
              "id": "4",
              "name": "prevention",
              "highlight": false
            },
           {
              "id": "22",
              "name": "medication",
              "highlight": true
            },
           {
              "id": "23",
              "name": "malaria",
              "highlight": false
            },
           {
              "id": "37",
              "name": "funding",
              "highlight": false
            },
           {
              "id": "39",
              "name": "malaria control",
              "highlight": false
            },
           {
              "id": "50",
              "name": "vaccination",
              "highlight": false
            },
           {
              "id": "65",
              "name": "international cooperation",
              "highlight": false
            }
         ]
       }
     ],
     "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>"
    },
   {
      "id": "29",
      "code": "A/RES/62/180",
      "organisation_id": "2",
      "is_ratified": null,
      "adoption_date": "2007-12-19",
      "slug": "29-2-aa-2-aa-decade-to-roll-back-",
      "DocumentType": {
        "id": "2",
        "name": "GA resolution",
        "legal_value": "non-legally binding"
      },
     "isSCResolution": false,
      "Organisation": {
        "name": "UNO GA"
      },
     "Tags": [
        {
          "id": "15",
          "name": "health care",
          "highlight": false
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "46",
          "name": "roll back malaria (rbm)",
          "highlight": false
        },
       {
          "id": "60",
          "name": "health",
          "highlight": false
        },
       {
          "id": "73",
          "name": "africa",
          "highlight": false
        }
     ],
     "Clauses": [
        {
          "id": "249",
          "document_id": "29",
          "slug": "249-a-res-62-180-13-commitment-mad",
          "clause_number": "13",
          "ClauseBody": {
            "id": "249",
            "root_clause_body_id": "226",
            "ClauseInformationType": {
              "id": "5",
              "name": "Commitment made by states (national action)"
            }
         },
         "clauseHistory": 0,
          "score": "100.00",
          "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
          "content": "Expresses its concern about the increase in resistant strains of malaria in \nseveral regions of the world, and <em>calls upon</em> Member States, with support from the World Health Organization, to strengthen surveillance systems for drug and insecticide resistance and for the World Health Organization to coordinate a network for the monitoring of drug and insecticide resistance",
          "Tags": [
            {
              "id": "11",
              "name": "national drug policy",
              "highlight": false
            },
           {
              "id": "22",
              "name": "medication",
              "highlight": true
            },
           {
              "id": "23",
              "name": "malaria",
              "highlight": false
            },
           {
              "id": "24",
              "name": "monitoring",
              "highlight": false
            },
           {
              "id": "30",
              "name": "insecticide",
              "highlight": false
            },
           {
              "id": "65",
              "name": "international cooperation",
              "highlight": false
            }
         ]
       }
     ],
     "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>"
    },
   {
      "id": "30",
      "code": "A/RES/63/234",
      "organisation_id": "2",
      "is_ratified": null,
      "adoption_date": "2008-12-22",
      "slug": "30-2-aa-2-aa-decade-to-roll-back-",
      "DocumentType": {
        "id": "2",
        "name": "GA resolution",
        "legal_value": "non-legally binding"
      },
     "isSCResolution": false,
      "Organisation": {
        "name": "UNO GA"
      },
     "Tags": [
        {
          "id": "15",
          "name": "health care",
          "highlight": false
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "46",
          "name": "roll back malaria (rbm)",
          "highlight": false
        },
       {
          "id": "60",
          "name": "health",
          "highlight": false
        },
       {
          "id": "73",
          "name": "africa",
          "highlight": false
        }
     ],
     "Clauses": [
        {
          "id": "278",
          "document_id": "30",
          "slug": "278-a-res-63-234-22-commitment-mad",
          "clause_number": "22",
          "ClauseBody": {
            "id": "278",
            "root_clause_body_id": "226",
            "ClauseInformationType": {
              "id": "5",
              "name": "Commitment made by states (national action)"
            }
         },
         "clauseHistory": 0,
          "score": "100.00",
          "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
          "content": "Expresses its concern about the increase in resistant strains of malaria in \nseveral regions of the world, and <em>calls upon</em> Member States, with support from the World Health Organization and other partners, to strengthen surveillance systems for drug and insecticide resistance and upon the World Health Organization to coordinate a global network for the monitoring of drug and insecticide resistance and to ensure that drug and insecticide testing is fully operational in order to enhance the use of current insecticide- and artemisinin-based combination therapies",
          "Tags": [
            {
              "id": "11",
              "name": "national drug policy",
              "highlight": false
            },
           {
              "id": "22",
              "name": "medication",
              "highlight": true
            },
           {
              "id": "23",
              "name": "malaria",
              "highlight": false
            },
           {
              "id": "24",
              "name": "monitoring",
              "highlight": false
            },
           {
              "id": "29",
              "name": "combination treatment",
              "highlight": false
            },
           {
              "id": "30",
              "name": "insecticide",
              "highlight": false
            },
           {
              "id": "65",
              "name": "international cooperation",
              "highlight": false
            }
         ]
       }
     ],
     "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>"
    },
   {
      "id": "31",
      "code": "A/RES/64/79",
      "organisation_id": "2",
      "is_ratified": null,
      "adoption_date": "2009-12-07",
      "slug": "31-2-aa-2-aa-decade-to-roll-back-",
      "DocumentType": {
        "id": "2",
        "name": "GA resolution",
        "legal_value": "non-legally binding"
      },
     "isSCResolution": false,
      "Organisation": {
        "name": "UNO GA"
      },
     "Tags": [
        {
          "id": "15",
          "name": "health care",
          "highlight": false
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "46",
          "name": "roll back malaria (rbm)",
          "highlight": false
        },
       {
          "id": "60",
          "name": "health",
          "highlight": false
        },
       {
          "id": "73",
          "name": "africa",
          "highlight": false
        }
     ],
     "Clauses": [
        {
          "id": "308",
          "document_id": "31",
          "slug": "308-a-res-64-79-19-commitment-made",
          "clause_number": "19",
          "ClauseBody": {
            "id": "308",
            "root_clause_body_id": "226",
            "ClauseInformationType": {
              "id": "5",
              "name": "Commitment made by states (national action)"
            }
         },
         "clauseHistory": 0,
          "score": "100.00",
          "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
          "content": "Expresses its concern about the increase in resistant strains of malaria in \nseveral regions of the world, and <em>calls upon</em> Member States, with support from the World Health Organization and other partners, to strengthen surveillance systems for drug and insecticide resistance and upon the World Health Organization to coordinate a global network for the monitoring of drug and insecticide resistance and to ensure that drug and insecticide testing is fully operational in order to enhance the use of current insecticide-and artemisinin-based combination therapies",
          "Tags": [
            {
              "id": "11",
              "name": "national drug policy",
              "highlight": false
            },
           {
              "id": "22",
              "name": "medication",
              "highlight": true
            },
           {
              "id": "23",
              "name": "malaria",
              "highlight": false
            },
           {
              "id": "24",
              "name": "monitoring",
              "highlight": false
            },
           {
              "id": "29",
              "name": "combination treatment",
              "highlight": false
            },
           {
              "id": "30",
              "name": "insecticide",
              "highlight": false
            },
           {
              "id": "65",
              "name": "international cooperation",
              "highlight": false
            }
         ]
       }
     ],
     "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>"
    }
 ],
 "filters": {
    "legal_value": [
      {
        "id": "non-legally binding",
        "name": "non-legally binding",
        "count": 17,
        "isChecked": true
      }
   ],
   "adoption_year": [
      {
        "id": 2003,
        "name": 2003,
        "count": 2,
        "isChecked": true
      },
     {
        "id": 2004,
        "name": 2004,
        "count": 2,
        "isChecked": true
      },
     {
        "id": 2005,
        "name": 2005,
        "count": 2,
        "isChecked": true
      },
     {
        "id": 2006,
        "name": 2006,
        "count": 2,
        "isChecked": true
      },
     {
        "id": 2007,
        "name": 2007,
        "count": 3,
        "isChecked": true
      },
     {
        "id": 2008,
        "name": 2008,
        "count": 3,
        "isChecked": true
      },
     {
        "id": 2009,
        "name": 2009,
        "count": 3,
        "isChecked": true
      }
   ],
   "organisation_id": [
      {
        "id": 2,
        "name": "UNO GA",
        "count": 17,
        "isChecked": true
      }
   ],
   "addressee_ids": [
      {
        "id": 6,
        "name": "International Community",
        "count": 6,
        "isChecked": true
      },
     {
        "id": 2,
        "name": "All Member States",
        "count": 3,
        "isChecked": true
      },
     {
        "id": 9,
        "name": "UN Organ",
        "count": 3,
        "isChecked": true
      },
     {
        "id": 7,
        "name": "Private sector",
        "count": 1,
        "isChecked": true
      }
   ],
   "documenttype_id": [
      {
        "id": 2,
        "name": "GA resolution",
        "count": 17,
        "isChecked": true
      }
   ],
   "information_type_id": [
      {
        "id": 4,
        "name": "Other important information",
        "count": 7,
        "isChecked": true
      },
     {
        "id": 6,
        "name": "Commitment made by states (international action)",
        "count": 6,
        "isChecked": true
      },
     {
        "id": 5,
        "name": "Commitment made by states (national action)",
        "count": 3,
        "isChecked": true
      },
     {
        "id": 3,
        "name": "Request to actors other than states",
        "count": 1,
        "isChecked": true
      }
   ],
   "operative_phrase_id": [
      {
        "id": 9,
        "name": "Calls upon",
        "count": 9,
        "isChecked": true
      },
     {
        "id": 22,
        "name": "Recognizes",
        "count": 7,
        "isChecked": true
      },
     {
        "id": 2,
        "name": "Urges",
        "count": 1,
        "isChecked": true
      }
   ],
   "tag_ids": [
      {
        "id": 22,
        "name": "medication",
        "count": 17,
        "isChecked": true
      },
     {
        "id": 23,
        "name": "malaria",
        "count": 17,
        "isChecked": true
      },
     {
        "id": 3,
        "name": "treatment",
        "count": 13,
        "isChecked": true
      },
     {
        "id": 39,
        "name": "malaria control",
        "count": 13,
        "isChecked": true
      },
     {
        "id": 4,
        "name": "prevention",
        "count": 12,
        "isChecked": true
      },
     {
        "id": 65,
        "name": "international cooperation",
        "count": 11,
        "isChecked": true
      },
     {
        "id": 30,
        "name": "insecticide",
        "count": 9,
        "isChecked": true
      },
     {
        "id": 49,
        "name": "research",
        "count": 9,
        "isChecked": true
      },
     {
        "id": 50,
        "name": "vaccination",
        "count": 7,
        "isChecked": true
      },
     {
        "id": 57,
        "name": "pharmaceuticals",
        "count": 7,
        "isChecked": true
      },
     {
        "id": 29,
        "name": "combination treatment",
        "count": 6,
        "isChecked": true
      },
     {
        "id": 37,
        "name": "funding",
        "count": 6,
        "isChecked": true
      },
     {
        "id": 31,
        "name": "pregnancy",
        "count": 5,
        "isChecked": true
      },
     {
        "id": 19,
        "name": "drug pricing",
        "count": 4,
        "isChecked": true
      },
     {
        "id": 11,
        "name": "national drug policy",
        "count": 3,
        "isChecked": true
      },
     {
        "id": 24,
        "name": "monitoring",
        "count": 3,
        "isChecked": true
      },
     {
        "id": 47,
        "name": "access to treatment",
        "count": 1,
        "isChecked": true
      }
   ]
 },
 "facets": {
    "legal_value": {
      "unfolded": false,
      "label": "Legal Value",
      "allChecked": true
    },
   "adoption_year": {
      "unfolded": false,
      "label": "Adoption Year",
      "allChecked": true
    },
   "organisation_id": {
      "model": "Organisation",
      "unfolded": true,
      "label": "Organisation",
      "allChecked": true
    },
   "addressee_ids": {
      "model": "Addressee",
      "unfolded": false,
      "label": "Addressees",
      "allChecked": true
    },
   "documenttype_id": {
      "model": "DocumentType",
      "unfolded": false,
      "label": "Document Type",
      "allChecked": true
    },
   "information_type_id": {
      "model": "ClauseInformationType",
      "unfolded": true,
      "label": "Clause Information Type",
      "allChecked": true
    },
   "operative_phrase_id": {
      "model": "ClauseOperativePhrase",
      "unfolded": false,
      "label": "Clause Operative Phrase",
      "allChecked": true
    },
   "tag_ids": {
      "model": "Tag",
      "unfolded": true,
      "label": "Tags",
      "allChecked": true
    }
 },
  "totalResults": 7,
  "page": 1,
  "limit": false,
  "status": "success",
  "message": "ok"
}
```

### to execute a clause search ###

  * url: http://resolutionfinder.org/search/results?q=africa&t[22]=medication&dc=&st=clause
  * note the `t[255]=war`, the relevant bit is the 255, which is the id of the tag "war". the above mentioned jquery autosuggest plugin does not support storing a different key for a tag value out of the box.
  * example reply:
```
{
  "searchType": "clause",
  "data": [
    {
      "id": "184",
      "document_id": "25",
      "slug": "184-a-res-58-237-7-other-important",
      "clause_number": "7",
      "ClauseBody": {
        "id": "184",
        "root_clause_body_id": null,
        "ClauseInformationType": {
          "id": "4",
          "name": "Other important information"
        }
     },
     "clauseHistory": 0,
      "score": "100.00",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Recognizes</em> the importance of the development of effective vaccines and \nnew medicines to prevent and treat malaria, and the need for further research, including through effective global partnerships such as the various malaria vaccine initiatives and the Medicines for Malaria Venture, in securing their development",
      "Tags": [
        {
          "id": "3",
          "name": "treatment",
          "highlight": false
        },
       {
          "id": "4",
          "name": "prevention",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "39",
          "name": "malaria control",
          "highlight": false
        },
       {
          "id": "50",
          "name": "vaccination",
          "highlight": false
        },
       {
          "id": "65",
          "name": "international cooperation",
          "highlight": false
        }
     ],
     "Document": {
        "id": "25",
        "code": "A/RES/58/237",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2003-12-23",
        "slug": "25-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "186",
      "document_id": "25",
      "slug": "186-a-res-58-237-9-request-to-acto",
      "clause_number": "9",
      "ClauseBody": {
        "id": "186",
        "root_clause_body_id": null,
        "ClauseInformationType": {
          "id": "3",
          "name": "Request to actors other than states"
        }
     },
     "clauseHistory": 0,
      "score": "100.00",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Urges</em> the pharmaceutical industry to take note of the increasing need for \neffective combination treatment for malaria, particularly in <strong>Africa</strong>, and to form additional alliances and partnerships to help to ensure that all people at risk have access to prompt, affordable and quality treatment;",
      "Tags": [
        {
          "id": "3",
          "name": "treatment",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "29",
          "name": "combination treatment",
          "highlight": false
        },
       {
          "id": "47",
          "name": "access to treatment",
          "highlight": false
        },
       {
          "id": "57",
          "name": "pharmaceuticals",
          "highlight": false
        },
       {
          "id": "65",
          "name": "international cooperation",
          "highlight": false
        }
     ],
     "Document": {
        "id": "25",
        "code": "A/RES/58/237",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2003-12-23",
        "slug": "25-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "197",
      "document_id": "26",
      "slug": "197-a-res-59-256-11-commitment-mad",
      "clause_number": "11",
      "ClauseBody": {
        "id": "197",
        "root_clause_body_id": null,
        "ClauseInformationType": {
          "id": "6",
          "name": "Commitment made by states (international action)"
        }
     },
     "clauseHistory": 0,
      "score": "100.00",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Calls upon</em> the international community to support investment in the \ndevelopment of new anti-malarial medicines and insecticides for the effective control of malaria in view of the challenging resistance of the parasite to anti-malarial medicines and the resistance of mosquitoes to insecticides",
      "Tags": [
        {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "30",
          "name": "insecticide",
          "highlight": false
        },
       {
          "id": "39",
          "name": "malaria control",
          "highlight": false
        },
       {
          "id": "49",
          "name": "research",
          "highlight": false
        },
       {
          "id": "57",
          "name": "pharmaceuticals",
          "highlight": false
        }
     ],
     "Document": {
        "id": "26",
        "code": "A/RES/59/256",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2004-12-23",
        "slug": "26-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "249",
      "document_id": "29",
      "slug": "249-a-res-62-180-13-commitment-mad",
      "clause_number": "13",
      "ClauseBody": {
        "id": "249",
        "root_clause_body_id": "226",
        "ClauseInformationType": {
          "id": "5",
          "name": "Commitment made by states (national action)"
        }
     },
     "clauseHistory": 0,
      "score": "100.00",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "Expresses its concern about the increase in resistant strains of malaria in \nseveral regions of the world, and <em>calls upon</em> Member States, with support from the World Health Organization, to strengthen surveillance systems for drug and insecticide resistance and for the World Health Organization to coordinate a network for the monitoring of drug and insecticide resistance",
      "Tags": [
        {
          "id": "11",
          "name": "national drug policy",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "24",
          "name": "monitoring",
          "highlight": false
        },
       {
          "id": "30",
          "name": "insecticide",
          "highlight": false
        },
       {
          "id": "65",
          "name": "international cooperation",
          "highlight": false
        }
     ],
     "Document": {
        "id": "29",
        "code": "A/RES/62/180",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2007-12-19",
        "slug": "29-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "278",
      "document_id": "30",
      "slug": "278-a-res-63-234-22-commitment-mad",
      "clause_number": "22",
      "ClauseBody": {
        "id": "278",
        "root_clause_body_id": "226",
        "ClauseInformationType": {
          "id": "5",
          "name": "Commitment made by states (national action)"
        }
     },
     "clauseHistory": 0,
      "score": "100.00",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "Expresses its concern about the increase in resistant strains of malaria in \nseveral regions of the world, and <em>calls upon</em> Member States, with support from the World Health Organization and other partners, to strengthen surveillance systems for drug and insecticide resistance and upon the World Health Organization to coordinate a global network for the monitoring of drug and insecticide resistance and to ensure that drug and insecticide testing is fully operational in order to enhance the use of current insecticide- and artemisinin-based combination therapies",
      "Tags": [
        {
          "id": "11",
          "name": "national drug policy",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "24",
          "name": "monitoring",
          "highlight": false
        },
       {
          "id": "29",
          "name": "combination treatment",
          "highlight": false
        },
       {
          "id": "30",
          "name": "insecticide",
          "highlight": false
        },
       {
          "id": "65",
          "name": "international cooperation",
          "highlight": false
        }
     ],
     "Document": {
        "id": "30",
        "code": "A/RES/63/234",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2008-12-22",
        "slug": "30-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "308",
      "document_id": "31",
      "slug": "308-a-res-64-79-19-commitment-made",
      "clause_number": "19",
      "ClauseBody": {
        "id": "308",
        "root_clause_body_id": "226",
        "ClauseInformationType": {
          "id": "5",
          "name": "Commitment made by states (national action)"
        }
     },
     "clauseHistory": 0,
      "score": "100.00",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "Expresses its concern about the increase in resistant strains of malaria in \nseveral regions of the world, and <em>calls upon</em> Member States, with support from the World Health Organization and other partners, to strengthen surveillance systems for drug and insecticide resistance and upon the World Health Organization to coordinate a global network for the monitoring of drug and insecticide resistance and to ensure that drug and insecticide testing is fully operational in order to enhance the use of current insecticide-and artemisinin-based combination therapies",
      "Tags": [
        {
          "id": "11",
          "name": "national drug policy",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "24",
          "name": "monitoring",
          "highlight": false
        },
       {
          "id": "29",
          "name": "combination treatment",
          "highlight": false
        },
       {
          "id": "30",
          "name": "insecticide",
          "highlight": false
        },
       {
          "id": "65",
          "name": "international cooperation",
          "highlight": false
        }
     ],
     "Document": {
        "id": "31",
        "code": "A/RES/64/79",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2009-12-07",
        "slug": "31-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "195",
      "document_id": "26",
      "slug": "195-a-res-59-256-9-other-important",
      "clause_number": "9",
      "ClauseBody": {
        "id": "195",
        "root_clause_body_id": "184",
        "ClauseInformationType": {
          "id": "4",
          "name": "Other important information"
        }
     },
     "clauseHistory": 0,
      "score": "86.42",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Recognizes</em> the importance of the development of effective vaccines and new medicines to prevent and treat malaria and the need for further and accelerated research, including through effective global partnerships such as the various malaria vaccine initiatives and the Medicines for Malaria Venture, where necessary stimulated by new incentives to secure their development",
      "Tags": [
        {
          "id": "3",
          "name": "treatment",
          "highlight": false
        },
       {
          "id": "4",
          "name": "prevention",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "37",
          "name": "funding",
          "highlight": false
        },
       {
          "id": "39",
          "name": "malaria control",
          "highlight": false
        },
       {
          "id": "50",
          "name": "vaccination",
          "highlight": false
        },
       {
          "id": "65",
          "name": "international cooperation",
          "highlight": false
        }
     ],
     "Document": {
        "id": "26",
        "code": "A/RES/59/256",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2004-12-23",
        "slug": "26-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "211",
      "document_id": "27",
      "slug": "211-a-res-60-221-13-other-importan",
      "clause_number": "13",
      "ClauseBody": {
        "id": "211",
        "root_clause_body_id": "184",
        "ClauseInformationType": {
          "id": "4",
          "name": "Other important information"
        }
     },
     "clauseHistory": 0,
      "score": "86.42",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Recognizes</em> the importance of the development of effective vaccines and \nnew medicines to prevent and treat malaria and the need for further and accelerated research, including by providing support to the United Nations Childrenâ€™s Fund/United Nations Development Programme/World Bank/World Health Organization Special Programme for Research and Training in Tropical Diseases and through effective global partnerships such as the various malaria vaccine initiatives and the Medicines for Malaria Venture, where necessary stimulated by new incentives to secure their development",
      "Tags": [
        {
          "id": "3",
          "name": "treatment",
          "highlight": false
        },
       {
          "id": "4",
          "name": "prevention",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "37",
          "name": "funding",
          "highlight": false
        },
       {
          "id": "39",
          "name": "malaria control",
          "highlight": false
        },
       {
          "id": "50",
          "name": "vaccination",
          "highlight": false
        },
       {
          "id": "65",
          "name": "international cooperation",
          "highlight": false
        }
     ],
     "Document": {
        "id": "27",
        "code": "A/RES/60/221",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2005-12-23",
        "slug": "27-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "212",
      "document_id": "27",
      "slug": "212-a-res-60-221-14-commitment-mad",
      "clause_number": "14",
      "ClauseBody": {
        "id": "212",
        "root_clause_body_id": "197",
        "ClauseInformationType": {
          "id": "6",
          "name": "Commitment made by states (international action)"
        }
     },
     "clauseHistory": 0,
      "score": "86.42",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Calls upon</em> the international community to support investment in the \ndevelopment of new medicines to prevent and treat malaria, especially for children and pregnant women, sensitive and specific diagnostic tests, effective vaccines, and new insecticides and delivery modes in order to enhance effectiveness and delay the onset of resistance, including through existing partnerships",
      "Tags": [
        {
          "id": "3",
          "name": "treatment",
          "highlight": false
        },
       {
          "id": "4",
          "name": "prevention",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "30",
          "name": "insecticide",
          "highlight": false
        },
       {
          "id": "31",
          "name": "pregnancy",
          "highlight": false
        },
       {
          "id": "39",
          "name": "malaria control",
          "highlight": false
        },
       {
          "id": "49",
          "name": "research",
          "highlight": false
        },
       {
          "id": "57",
          "name": "pharmaceuticals",
          "highlight": false
        }
     ],
     "Document": {
        "id": "27",
        "code": "A/RES/60/221",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2005-12-23",
        "slug": "27-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "228",
      "document_id": "28",
      "slug": "228-a-res-61-228-14-other-importan",
      "clause_number": "14",
      "ClauseBody": {
        "id": "228",
        "root_clause_body_id": "184",
        "ClauseInformationType": {
          "id": "4",
          "name": "Other important information"
        }
     },
     "clauseHistory": 0,
      "score": "86.42",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Recognizes</em> the importance of the development of safe and cost-effective \nvaccines and new medicines to prevent and treat malaria and the need for further and accelerated research, including into safe, effective and high-quality traditional therapies, using rigorous standards, including by providing support to the Special Programme for Research and Training in Tropical Diseases and through effective global partnerships such as the various malaria vaccine initiatives and the Medicines for Malaria Venture, where necessary stimulated by new incentives to secure their development",
      "Tags": [
        {
          "id": "3",
          "name": "treatment",
          "highlight": false
        },
       {
          "id": "4",
          "name": "prevention",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "37",
          "name": "funding",
          "highlight": false
        },
       {
          "id": "39",
          "name": "malaria control",
          "highlight": false
        },
       {
          "id": "50",
          "name": "vaccination",
          "highlight": false
        },
       {
          "id": "65",
          "name": "international cooperation",
          "highlight": false
        }
     ],
     "Document": {
        "id": "28",
        "code": "A/RES/61/228",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2006-12-22",
        "slug": "28-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "229",
      "document_id": "28",
      "slug": "229-a-res-61-228-15-commitment-mad",
      "clause_number": "15",
      "ClauseBody": {
        "id": "229",
        "root_clause_body_id": "197",
        "ClauseInformationType": {
          "id": "6",
          "name": "Commitment made by states (international action)"
        }
     },
     "clauseHistory": 0,
      "score": "86.42",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Calls upon</em> the international community, including through existing \npartnerships, to increase investment in and efforts towards the research and development of new, safe and affordable malaria-related medicines, products and technologies, such as vaccines, rapid diagnostic tests, insecticides and delivery modes, to prevent and treat malaria, especially for at-risk children and pregnant women, in order to enhance effectiveness and delay the onset of resistance",
      "Tags": [
        {
          "id": "3",
          "name": "treatment",
          "highlight": false
        },
       {
          "id": "4",
          "name": "prevention",
          "highlight": false
        },
       {
          "id": "19",
          "name": "drug pricing",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "30",
          "name": "insecticide",
          "highlight": false
        },
       {
          "id": "31",
          "name": "pregnancy",
          "highlight": false
        },
       {
          "id": "39",
          "name": "malaria control",
          "highlight": false
        },
       {
          "id": "49",
          "name": "research",
          "highlight": false
        },
       {
          "id": "57",
          "name": "pharmaceuticals",
          "highlight": false
        }
     ],
     "Document": {
        "id": "28",
        "code": "A/RES/61/228",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2006-12-22",
        "slug": "28-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "251",
      "document_id": "29",
      "slug": "251-a-res-62-180-15-other-importan",
      "clause_number": "15",
      "ClauseBody": {
        "id": "251",
        "root_clause_body_id": "184",
        "ClauseInformationType": {
          "id": "4",
          "name": "Other important information"
        }
     },
     "clauseHistory": 0,
      "score": "86.42",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Recognizes</em> the importance of the development of safe and cost-effective \nvaccines and new medicines to prevent and treat malaria and the need for further and accelerated research, including into safe, effective and high-quality traditional therapies, using rigorous standards, including by providing support to the Special Programme for Research and Training in Tropical Diseases and through effective global partnerships such as the various malaria vaccine initiatives and the Medicines for Malaria Venture, where necessary stimulated by new incentives to secure their development and through effective and timely support towards pre-qualification of new antimalarials and their combinations",
      "Tags": [
        {
          "id": "3",
          "name": "treatment",
          "highlight": false
        },
       {
          "id": "4",
          "name": "prevention",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "29",
          "name": "combination treatment",
          "highlight": false
        },
       {
          "id": "37",
          "name": "funding",
          "highlight": false
        },
       {
          "id": "39",
          "name": "malaria control",
          "highlight": false
        },
       {
          "id": "49",
          "name": "research",
          "highlight": false
        },
       {
          "id": "50",
          "name": "vaccination",
          "highlight": false
        },
       {
          "id": "65",
          "name": "international cooperation",
          "highlight": false
        }
     ],
     "Document": {
        "id": "29",
        "code": "A/RES/62/180",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2007-12-19",
        "slug": "29-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "252",
      "document_id": "29",
      "slug": "252-a-res-62-180-16-commitment-mad",
      "clause_number": "16",
      "ClauseBody": {
        "id": "252",
        "root_clause_body_id": "197",
        "ClauseInformationType": {
          "id": "6",
          "name": "Commitment made by states (international action)"
        }
     },
     "clauseHistory": 0,
      "score": "86.42",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Calls upon</em> the international community, including through existing \npartnerships, to increase investment in and efforts towards the research and development of new, safe and affordable malaria-related medicines, products and technologies, such as vaccines, rapid diagnostic tests, insecticides and delivery modes, to prevent and treat malaria, especially for at-risk children and pregnant women, in order to enhance effectiveness and delay the onset of resistance",
      "Tags": [
        {
          "id": "3",
          "name": "treatment",
          "highlight": false
        },
       {
          "id": "4",
          "name": "prevention",
          "highlight": false
        },
       {
          "id": "19",
          "name": "drug pricing",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "30",
          "name": "insecticide",
          "highlight": false
        },
       {
          "id": "31",
          "name": "pregnancy",
          "highlight": false
        },
       {
          "id": "39",
          "name": "malaria control",
          "highlight": false
        },
       {
          "id": "49",
          "name": "research",
          "highlight": false
        },
       {
          "id": "57",
          "name": "pharmaceuticals",
          "highlight": false
        }
     ],
     "Document": {
        "id": "29",
        "code": "A/RES/62/180",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2007-12-19",
        "slug": "29-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "280",
      "document_id": "30",
      "slug": "280-a-res-63-234-24-other-importan",
      "clause_number": "24",
      "ClauseBody": {
        "id": "280",
        "root_clause_body_id": "184",
        "ClauseInformationType": {
          "id": "4",
          "name": "Other important information"
        }
     },
     "clauseHistory": 0,
      "score": "86.42",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Recognizes</em> the importance of the development of safe and cost-effective \nvaccines and new medicines to prevent and treat malaria and the need for further and accelerated research, including into safe, effective and high-quality traditional therapies, using rigorous standards, including by providing support to the Special Programme for Research and Training in Tropical Diseases and through effective global partnerships, such as the various malaria vaccine initiatives and the Medicines for Malaria Venture, where necessary stimulated by new incentives to secure their development and through effective and timely support towards pre-qualification of new antimalarials and their combinations",
      "Tags": [
        {
          "id": "3",
          "name": "treatment",
          "highlight": false
        },
       {
          "id": "4",
          "name": "prevention",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "29",
          "name": "combination treatment",
          "highlight": false
        },
       {
          "id": "37",
          "name": "funding",
          "highlight": false
        },
       {
          "id": "39",
          "name": "malaria control",
          "highlight": false
        },
       {
          "id": "49",
          "name": "research",
          "highlight": false
        },
       {
          "id": "50",
          "name": "vaccination",
          "highlight": false
        },
       {
          "id": "65",
          "name": "international cooperation",
          "highlight": false
        }
     ],
     "Document": {
        "id": "30",
        "code": "A/RES/63/234",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2008-12-22",
        "slug": "30-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "281",
      "document_id": "30",
      "slug": "281-a-res-63-234-25-commitment-mad",
      "clause_number": "25",
      "ClauseBody": {
        "id": "281",
        "root_clause_body_id": "197",
        "ClauseInformationType": {
          "id": "6",
          "name": "Commitment made by states (international action)"
        }
     },
     "clauseHistory": 0,
      "score": "86.42",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Calls upon</em> the international community, including through existing \npartnerships, to increase investment in and efforts towards the research and development of new, safe and affordable malaria-related medicines, products and technologies, such as vaccines, rapid diagnostic tests, insecticides and delivery modes, to prevent and treat malaria, especially for at-risk children and pregnant women, in order to enhance effectiveness and delay the onset of resistance",
      "Tags": [
        {
          "id": "3",
          "name": "treatment",
          "highlight": false
        },
       {
          "id": "4",
          "name": "prevention",
          "highlight": false
        },
       {
          "id": "19",
          "name": "drug pricing",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "30",
          "name": "insecticide",
          "highlight": false
        },
       {
          "id": "31",
          "name": "pregnancy",
          "highlight": false
        },
       {
          "id": "39",
          "name": "malaria control",
          "highlight": false
        },
       {
          "id": "49",
          "name": "research",
          "highlight": false
        },
       {
          "id": "57",
          "name": "pharmaceuticals",
          "highlight": false
        }
     ],
     "Document": {
        "id": "30",
        "code": "A/RES/63/234",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2008-12-22",
        "slug": "30-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "310",
      "document_id": "31",
      "slug": "310-a-res-64-79-21-other-important",
      "clause_number": "21",
      "ClauseBody": {
        "id": "310",
        "root_clause_body_id": "184",
        "ClauseInformationType": {
          "id": "4",
          "name": "Other important information"
        }
     },
     "clauseHistory": 0,
      "score": "86.42",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Recognizes</em> the importance of the development of safe and cost-effective \nvaccines and new medicines to prevent and treat malaria and the need for further and accelerated research, including into safe, effective and high-quality traditional therapies, using rigorous standards, including by providing support to the Special Programme for Research and Training in Tropical Diseases and through effective global partnerships, such as the various malaria vaccine initiatives and the Medicines for Malaria Venture, \nwhere necessary stimulated by new incentives to secure their development and through effective and timely support towards pre-qualification of new antimalarials and their combinations",
      "Tags": [
        {
          "id": "3",
          "name": "treatment",
          "highlight": false
        },
       {
          "id": "4",
          "name": "prevention",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "29",
          "name": "combination treatment",
          "highlight": false
        },
       {
          "id": "37",
          "name": "funding",
          "highlight": false
        },
       {
          "id": "39",
          "name": "malaria control",
          "highlight": false
        },
       {
          "id": "49",
          "name": "research",
          "highlight": false
        },
       {
          "id": "50",
          "name": "vaccination",
          "highlight": false
        },
       {
          "id": "65",
          "name": "international cooperation",
          "highlight": false
        }
     ],
     "Document": {
        "id": "31",
        "code": "A/RES/64/79",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2009-12-07",
        "slug": "31-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   },
   {
      "id": "311",
      "document_id": "31",
      "slug": "311-a-res-64-79-22-commitment-made",
      "clause_number": "22",
      "ClauseBody": {
        "id": "311",
        "root_clause_body_id": "197",
        "ClauseInformationType": {
          "id": "6",
          "name": "Commitment made by states (international action)"
        }
     },
     "clauseHistory": 0,
      "score": "86.42",
      "documentTitle": "2001â€“2010: Decade to Roll Back Malaria in Developing Countries, Particularly in <strong>Africa</strong>",
      "content": "<em>Calls upon</em> the international community, including through existing \npartnerships, to increase investment in and efforts towards the research and development of new, safe and affordable malaria-related medicines, products and technologies, such as vaccines, rapid diagnostic tests, insecticides and delivery modes, to prevent and treat malaria, especially for at-risk children and pregnant women, in order to enhance effectiveness anddelaythe onset of resistance",
      "Tags": [
        {
          "id": "3",
          "name": "treatment",
          "highlight": false
        },
       {
          "id": "4",
          "name": "prevention",
          "highlight": false
        },
       {
          "id": "19",
          "name": "drug pricing",
          "highlight": false
        },
       {
          "id": "22",
          "name": "medication",
          "highlight": true
        },
       {
          "id": "23",
          "name": "malaria",
          "highlight": false
        },
       {
          "id": "30",
          "name": "insecticide",
          "highlight": false
        },
       {
          "id": "31",
          "name": "pregnancy",
          "highlight": false
        },
       {
          "id": "39",
          "name": "malaria control",
          "highlight": false
        },
       {
          "id": "49",
          "name": "research",
          "highlight": false
        },
       {
          "id": "57",
          "name": "pharmaceuticals",
          "highlight": false
        }
     ],
     "Document": {
        "id": "31",
        "code": "A/RES/64/79",
        "organisation_id": "2",
        "is_ratified": null,
        "adoption_date": "2009-12-07",
        "slug": "31-2-aa-2-aa-decade-to-roll-back-",
        "DocumentType": {
          "id": "2",
          "name": "GA resolution",
          "legal_value": "non-legally binding"
        },
       "isSCResolution": false,
        "Organisation": {
          "name": "UNO GA"
        }
     }
   }
 ],
 "filters": {
    "legal_value": [
      {
        "id": "non-legally binding",
        "name": "non-legally binding",
        "count": 17,
        "isChecked": true
      }
   ],
   "adoption_year": [
      {
        "id": 2003,
        "name": 2003,
        "count": 2,
        "isChecked": true
      },
     {
        "id": 2004,
        "name": 2004,
        "count": 2,
        "isChecked": true
      },
     {
        "id": 2005,
        "name": 2005,
        "count": 2,
        "isChecked": true
      },
     {
        "id": 2006,
        "name": 2006,
        "count": 2,
        "isChecked": true
      },
     {
        "id": 2007,
        "name": 2007,
        "count": 3,
        "isChecked": true
      },
     {
        "id": 2008,
        "name": 2008,
        "count": 3,
        "isChecked": true
      },
     {
        "id": 2009,
        "name": 2009,
        "count": 3,
        "isChecked": true
      }
   ],
   "organisation_id": [
      {
        "id": 2,
        "name": "UNO GA",
        "count": 17,
        "isChecked": true
      }
   ],
   "addressee_ids": [
      {
        "id": 6,
        "name": "International Community",
        "count": 6,
        "isChecked": true
      },
     {
        "id": 2,
        "name": "All Member States",
        "count": 3,
        "isChecked": true
      },
     {
        "id": 9,
        "name": "UN Organ",
        "count": 3,
        "isChecked": true
      },
     {
        "id": 7,
        "name": "Private sector",
        "count": 1,
        "isChecked": true
      }
   ],
   "documenttype_id": [
      {
        "id": 2,
        "name": "GA resolution",
        "count": 17,
        "isChecked": true
      }
   ],
   "information_type_id": [
      {
        "id": 4,
        "name": "Other important information",
        "count": 7,
        "isChecked": true
      },
     {
        "id": 6,
        "name": "Commitment made by states (international action)",
        "count": 6,
        "isChecked": true
      },
     {
        "id": 5,
        "name": "Commitment made by states (national action)",
        "count": 3,
        "isChecked": true
      },
     {
        "id": 3,
        "name": "Request to actors other than states",
        "count": 1,
        "isChecked": true
      }
   ],
   "operative_phrase_id": [
      {
        "id": 9,
        "name": "Calls upon",
        "count": 9,
        "isChecked": true
      },
     {
        "id": 22,
        "name": "Recognizes",
        "count": 7,
        "isChecked": true
      },
     {
        "id": 2,
        "name": "Urges",
        "count": 1,
        "isChecked": true
      }
   ],
   "tag_ids": [
      {
        "id": 22,
        "name": "medication",
        "count": 17,
        "isChecked": true
      },
     {
        "id": 23,
        "name": "malaria",
        "count": 17,
        "isChecked": true
      },
     {
        "id": 3,
        "name": "treatment",
        "count": 13,
        "isChecked": true
      },
     {
        "id": 39,
        "name": "malaria control",
        "count": 13,
        "isChecked": true
      },
     {
        "id": 4,
        "name": "prevention",
        "count": 12,
        "isChecked": true
      },
     {
        "id": 65,
        "name": "international cooperation",
        "count": 11,
        "isChecked": true
      },
     {
        "id": 30,
        "name": "insecticide",
        "count": 9,
        "isChecked": true
      },
     {
        "id": 49,
        "name": "research",
        "count": 9,
        "isChecked": true
      },
     {
        "id": 50,
        "name": "vaccination",
        "count": 7,
        "isChecked": true
      },
     {
        "id": 57,
        "name": "pharmaceuticals",
        "count": 7,
        "isChecked": true
      },
     {
        "id": 29,
        "name": "combination treatment",
        "count": 6,
        "isChecked": true
      },
     {
        "id": 37,
        "name": "funding",
        "count": 6,
        "isChecked": true
      },
     {
        "id": 31,
        "name": "pregnancy",
        "count": 5,
        "isChecked": true
      },
     {
        "id": 19,
        "name": "drug pricing",
        "count": 4,
        "isChecked": true
      },
     {
        "id": 11,
        "name": "national drug policy",
        "count": 3,
        "isChecked": true
      },
     {
        "id": 24,
        "name": "monitoring",
        "count": 3,
        "isChecked": true
      },
     {
        "id": 47,
        "name": "access to treatment",
        "count": 1,
        "isChecked": true
      }
   ]
 },
 "facets": {
    "legal_value": {
      "unfolded": false,
      "label": "Legal Value",
      "allChecked": true
    },
   "adoption_year": {
      "unfolded": false,
      "label": "Adoption Year",
      "allChecked": true
    },
   "organisation_id": {
      "model": "Organisation",
      "unfolded": true,
      "label": "Organisation",
      "allChecked": true
    },
   "addressee_ids": {
      "model": "Addressee",
      "unfolded": false,
      "label": "Addressees",
      "allChecked": true
    },
   "documenttype_id": {
      "model": "DocumentType",
      "unfolded": false,
      "label": "Document Type",
      "allChecked": true
    },
   "information_type_id": {
      "model": "ClauseInformationType",
      "unfolded": true,
      "label": "Clause Information Type",
      "allChecked": true
    },
   "operative_phrase_id": {
      "model": "ClauseOperativePhrase",
      "unfolded": false,
      "label": "Clause Operative Phrase",
      "allChecked": true
    },
   "tag_ids": {
      "model": "Tag",
      "unfolded": true,
      "label": "Tags",
      "allChecked": true
    }
 },
  "totalResults": 17,
  "page": 0,
  "limit": 20,
  "status": "success",
  "message": "ok"
}
```