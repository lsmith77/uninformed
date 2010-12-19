<?php

slot('title', 'Help ResolutionFinder.org');
slot('description', 'Help about terms used on ResolutionFinder.org');
slot('robots', 'INDEX, FOLLOW');

?>

<h1>Help for ResolutionFinder.org</h1>

<div class="demo">

    <div id="tabs">
        <ul>
            <li><a href="#tags">Tags</a></li>
            <li><a href="#search">Search</a></li>
            <li><a href="#clause-history">Clause History</a></li>
            <li><a href="#legal-values">Legal Values</a></li>
            <li><a href="#addressees">Addressees</a></li>
            <li><a href="#information-types">Information Types</a></li>
            <li><a href="#document-types">Document Types</a></li>
        </ul>
        <div id="tags">
            <p>Tags are non-hierarchical keywords or terms assigned to documents and clauses. This kind of metadata
                helps describe the information available on ResolutionFinder.org and it allows it to be found again by
                browsing. The tagging list has been open so far and the choice to assign particular tags to each clause
                and document has been done by the researchers who completed the process of extracting and classifying
                the clauses. All the tags currently available on ResolutionFinder.org are part of the UN lingo (i.e.
                words and expressions from UN documents in their initial form).</p>
        </div>
        <div id="search">
            <p>The document and clause search allows for both a free search as well as a search by tag and document code.
                The tag search is meant to help the user find the desired results by suggesting tags assigned to the
                clauses and documents. Especially the search for clauses will usually yield a significant number of
                results which can then be narrowed down using the filters provided by ResolutionFinder.org. Filtering
                by document code is a very effective way for experts to filter out non related documents.</p>

            <p>Support for complex queries allows users to specify their search preferences in the search box, by asking
                deliberately including/excluding particular information from the results or to look for specific
                phrases. Phrases are enclosed in double quotes ('"'), inclusion is made prefixing with plus sign ("+"),
                exclusion is made prefixing with a minus sign ("-"). For instance the following search will list all the
                results containing the phrase "security council" and the word "africa", but which do not include the
                word "regional": "security council" +africa  -regional </p>

            <p>Here is an <?php echo link_to('example', '@search?q=%22security+council%22+%2Bafrica+-regional&t%5B23%5D=malaria&dc=A%2FRES*&st=clause&p=0'); ?>
                search that searches for clauses:
                <ul>
                    <li>text containing: "security council" +africa  -regional</li>
                    <li>tagged with: malaria</li>
                    <li>document code starting with: A/RES
                </ul>
            </p>
        </div>
        <div id="clause-history">
            <p>The history of the clause aims to illustrate the evolution of clauses from within follow-up documents
                (documents which have been adopted several years in a row). The clause history underlines all the
                modifications brought to a particular clause throughout the years at a linguistic level.</p>
        </div>
        <div id="legal-values">
            <p>In order to determine the legal value of a document we only use formal criteria. We distinguish between
                legally binding documents, non legally binding documents and Security Council resolutions.</p>

            <div id="legal-values-accordion">

            <h3><a href="#">Legally binding</a></h3>
            <div>
                For legally binding documents ResolutionFinder considers multilateral conventions of potential universal
                adherence registered with the UN in accordance with Art. 102 of the UN Charter or deposited with the
                Secretary-General of the UN. In order to show whether a document has reached the minimum ratification
                count yet, we mark legally binding documents in force or not in force differently.
            </div>

            <h3><a href="#">Non legally binding</a></h3>
            <div>
                Non legally binding are all those documents that have been negotiated by states and are also addressed
                to them, but are not by their form legally binding. Non-legally binding agreements consequently
                encompass international agreements negotiated under the auspices of the UN at global summits and other
                multilateral gatherings. They also cover UN resolutions passed by the main United Nations organs and
                their subsidiary bodies, as well as recommendations, regulations, plans of actions and other types of
                agreements issued by Specialised and Related Agencies.
            </div>

            <h3><a href="#">SC resolutions</a></h3>
            <div>
                Security Council resolutions are left out of the above classification into legally binding or non
                legally binding documents. While they constitute UN agreements, they cannot be classified into a
                category merely by their form. Therefore, ResolutionFinder.org has refrained from assigning them a legal
                value, and provisions from Security Council resolutions are marked differently, so as to make the
                specific nature of these agreements visible.
            </div>

            <h3><a href="#">Agreements not negotiated within the UN system</a></h3>
            <div>
                As a general rule, Jungle Drum does not consider international agreements from outside the UN system.
                However, evaluation of the research showed that there are certain agreements not issued within the UN
                system that are nevertheless connected to the UN. These are documents that are negotiated by states,
                and additionally are either global in nature (i.e. negotiated in a multilateral forum outside of the UN
                system) or have been recalled in a UN agreement (i.e. they have been processed to the UN by the relevant
                regional authority by way of an annex to a letter, and have been assigned a UN document number). These
                documents were also included into Jungle Drum's UN Agreements research.
            </div>

            </div>
        </div>
        <div id="addressees">
            <p>The addressee of a given clause is the person, organisation or group of states the clause is directed to:</p>

            <ul>
                <li>All Member States</li>
                <li>Group of States</li>
                <li>International Community</li>
                <li>UN Secretary General</li>
                <li>UN Organ</li>
                <li>Private Sector</li>
                <li>Civil Society</li>
                <li>"Major groups"</li>
                <li>Regional Organizations</li>
                <li>Multilateral Organizations</li>
                <li>Organizations</li>
                <li>National Organizations</li>
                <li>Other</li>
            </ul>
        </div>
        <div id="information-types">
            <p>Because agreements that are legally binding by form sometimes contain quite indeterminate language, and
                in turn, provisions from agreements that are by form non-legally binding may be supported by a large
                number of states to such a degree that they might amount to legally binding norms. Such cases are
                usually difficult to identify, and often disputed. Classification via abstract criteria cannot take
                into account such disputed cases. Consequently, ResolutionFinder assigns information types in order to
                classify documents independently from their legal value. We distinguish between the following
                information types:</p>

            <div id="information-types-accordion">

            <h3><a href="#">Commitments made by states</a></h3>
            <div>
                Commitments made by states are understood as clauses from UN agreements containing measures that need to
                be carried out by states. The addressee of such a clause thus needs to be the states themselves. From a
                legal point of view, it could be contested that such clauses reflect a legally relevant agreement, since
                they technically reflect the view of the respective issuing organ. However, the fact that the issuing
                organ is in fact composed of state representatives needs to be taken into consideration: Regardless of
                any legal qualification, clauses adopted by states and addressed at states can be considered as a
                commitment on a political level. Commitments made by states are divided into national level and
                international level, depending on whether the measure needs to be implemented domestically or
                regionally/globally.                
            </div>

            <h3><a href="#">Further recommendations for implementation</a></h3>
            <div>
                While a large amount of clauses contain measures to be undertaken by states, they are not necessarily
                commitments in the sense that they merely recommend action to states. Such clauses are considered as
                constituting further recommendations for implementation.
            </div>


            <h3><a href="#">requests to UN institution</a></h3>
            <div>
                Clauses addressed to an organ within the UN System, i.e. such clauses that specifically address the part
                of the UN System (be it an organ of an international organization, or specific parts of the various
                Secretariats of international organizations), have been defined as requests to UN institution.
            </div>

            <h3><a href="#">Request and recommendations to actors other than states</a></h3>
            <div>
                Clauses addressed to actors other than states are split into requests and recommendations to actors
                other than states. Due to the great diversity of language used when determining the addressee, no
                further differentiation as to the term actors other than states is used.
            </div>

            </div>
        </div>
        <div id="document-types">
            <table>
                <tr>
                    <th>Document Type</th>
                    <th>Legal Value</th>
                </tr>
                <tr>
                    <td>Treaty/Convention/Covenant</td>
                    <td>Legally binding</td>
                </tr>
                <tr>
                    <td>Protocol to Convention</td>
                    <td>Legally binding</td>
                </tr>
                <tr>
                    <td>Declaration</td>
                    <td>Non-legally binding</td>
                </tr>
                <tr>
                    <td>Plan of action</td>
                    <td>Non-legally binding</td>
                </tr>
                <tr>
                    <td>GA Resolution</td>
                    <td>Non-legally binding</td>
                </tr>
                <tr>
                    <td>SC Resolution</td>
                    <td>ResolutionFinder.org does not assign a legal value to SC Resolutions</td>
                </tr>
                <tr>
                    <td>Decision</td>
                    <td>Non-legally binding</td>
                </tr>
                <tr>
                    <td>Recommendation</td>
                    <td>Non-legally binding</td>
                </tr>
                <tr>
                    <td>Conclusion</td>
                    <td>Non-legally binding</td>
                </tr>
                <tr>
                    <td>Presidential Statement</td>
                    <td>Non-legally binding</td>
                </tr>
            </table>
        </div>
    </div>

</div>

<div class="demo-description" style="display: none; ">

    <p>Click tabs to swap between content that is broken into logical sections.</p>

</div>
