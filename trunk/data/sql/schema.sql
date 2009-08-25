CREATE TABLE clauses (clause_id INT UNSIGNED AUTO_INCREMENT, name VARCHAR(45) NOT NULL, document_id INT UNSIGNED NOT NULL, clause_number INT NOT NULL, parent_clause_id INT UNSIGNED, information_type VARCHAR(45), operative_phrase VARCHAR(45), adressee VARCHAR(45), relevance VARCHAR(45), significants VARCHAR(45), content TEXT, created_at DATETIME, updated_at DATETIME, INDEX document_id_idx (document_id), INDEX parent_clause_id_idx (parent_clause_id), PRIMARY KEY(clause_id)) ENGINE = INNODB;
CREATE TABLE clause2tag (clause_id INT UNSIGNED, tag_id INT UNSIGNED, PRIMARY KEY(clause_id, tag_id)) ENGINE = INNODB;
CREATE TABLE documents (document_id INT UNSIGNED AUTO_INCREMENT, name VARCHAR(45) NOT NULL, publication_date DATE NOT NULL, documenttype_id INT UNSIGNED NOT NULL, legal_value VARCHAR(45), organisation_id INT UNSIGNED NOT NULL, adoption_date DATETIME, code VARCHAR(45), min_ratification_count INT, preamble TEXT, created_at DATETIME, updated_at DATETIME, INDEX documenttype_id_idx (documenttype_id), INDEX organisation_id_idx (organisation_id), PRIMARY KEY(document_id)) ENGINE = INNODB;
CREATE TABLE documentrelations (document_id INT UNSIGNED, related_document_id INT UNSIGNED, relation_type VARCHAR(8), PRIMARY KEY(document_id, related_document_id, relation_type)) ENGINE = INNODB;
CREATE TABLE document2tag (document_id INT UNSIGNED, tag_id INT UNSIGNED, PRIMARY KEY(document_id, tag_id)) ENGINE = INNODB;
CREATE TABLE documenttypes (documenttype_id INT UNSIGNED AUTO_INCREMENT, name VARCHAR(45) NOT NULL, legal_value VARCHAR(45) NOT NULL, PRIMARY KEY(documenttype_id)) ENGINE = INNODB;
CREATE TABLE memberstates (memberstate_id INT UNSIGNED AUTO_INCREMENT, name VARCHAR(45) NOT NULL, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(memberstate_id)) ENGINE = INNODB;
CREATE TABLE memberstates2organisations (memberstate_id INT UNSIGNED, organisation_id INT UNSIGNED, PRIMARY KEY(memberstate_id, organisation_id)) ENGINE = INNODB;
CREATE TABLE organisations (organisation_id INT UNSIGNED AUTO_INCREMENT, name VARCHAR(45) NOT NULL, parent_organisation_id INT UNSIGNED, created_at DATETIME, updated_at DATETIME, INDEX parent_organisation_id_idx (parent_organisation_id), PRIMARY KEY(organisation_id)) ENGINE = INNODB;
CREATE TABLE tags (tag_id INT UNSIGNED AUTO_INCREMENT, name VARCHAR(45) NOT NULL, tag_type VARCHAR(13), created_at DATETIME, updated_at DATETIME, PRIMARY KEY(tag_id)) ENGINE = INNODB;
CREATE TABLE taghierachie2tag (taghierachie_id INT UNSIGNED, tag_id INT UNSIGNED, PRIMARY KEY(taghierachie_id, tag_id)) ENGINE = INNODB;
CREATE TABLE taghierarchies (taghierarchie_id INT UNSIGNED AUTO_INCREMENT, name VARCHAR(45) NOT NULL, hierachie_level VARCHAR(7) NOT NULL, parent_taghierarchie_id INT UNSIGNED, PRIMARY KEY(taghierarchie_id)) ENGINE = INNODB;
CREATE TABLE taghierarchie2tag (taghierarchie_id INT UNSIGNED, tag_id INT UNSIGNED, PRIMARY KEY(taghierarchie_id, tag_id)) ENGINE = INNODB;
CREATE TABLE tagimplications (tag_id INT UNSIGNED, implied_tag_id INT UNSIGNED, implication_type VARCHAR(8) NOT NULL, PRIMARY KEY(tag_id, implied_tag_id)) ENGINE = INNODB;
CREATE TABLE votingrecords (document_id INT UNSIGNED, memberstate_id INT UNSIGNED, vote_type VARCHAR(7) NOT NULL, PRIMARY KEY(document_id, memberstate_id)) ENGINE = INNODB;
ALTER TABLE clauses ADD FOREIGN KEY (parent_clause_id) REFERENCES clauses(clause_id);
ALTER TABLE clauses ADD FOREIGN KEY (document_id) REFERENCES documents(document_id);
ALTER TABLE clause2tag ADD FOREIGN KEY (clause_id) REFERENCES clauses(clause_id);
ALTER TABLE documents ADD FOREIGN KEY (organisation_id) REFERENCES organisations(organisation_id);
ALTER TABLE documents ADD FOREIGN KEY (documenttype_id) REFERENCES documenttypes(documenttype_id);
ALTER TABLE documentrelations ADD FOREIGN KEY (related_document_id) REFERENCES documents(document_id);
ALTER TABLE documentrelations ADD FOREIGN KEY (document_id) REFERENCES documents(document_id);
ALTER TABLE document2tag ADD FOREIGN KEY (document_id) REFERENCES documents(document_id);
ALTER TABLE memberstates2organisations ADD FOREIGN KEY (memberstate_id) REFERENCES memberstates(memberstate_id);
ALTER TABLE organisations ADD FOREIGN KEY (parent_organisation_id) REFERENCES organisations(organisation_id);
ALTER TABLE taghierarchie2tag ADD FOREIGN KEY (taghierarchie_id) REFERENCES taghierarchies(taghierarchie_id);
ALTER TABLE taghierarchie2tag ADD FOREIGN KEY (tag_id) REFERENCES tags(tag_id);
ALTER TABLE tagimplications ADD FOREIGN KEY (tag_id) REFERENCES tags(tag_id);
ALTER TABLE tagimplications ADD FOREIGN KEY (implied_tag_id) REFERENCES tags(tag_id);
ALTER TABLE votingrecords ADD FOREIGN KEY (memberstate_id) REFERENCES organisations(organisation_id);
ALTER TABLE votingrecords ADD FOREIGN KEY (document_id) REFERENCES documents(document_id);
