CREATE TABLE addressee (id INT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE bookmark (id INT AUTO_INCREMENT, user_id INT NOT NULL, object_type INT NOT NULL, object_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX mapping_idx (user_id, object_type, object_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE clause (id INT AUTO_INCREMENT, document_id INT NOT NULL, clause_body_id INT NOT NULL, clause_number INT NOT NULL, clause_number_information VARCHAR(255), clause_number_subparagraph VARCHAR(255), private_comment LONGTEXT, slug VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, UNIQUE INDEX mapping_idx (document_id, clause_body_id), INDEX document_id_idx (document_id), INDEX clause_body_id_idx (clause_body_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE clause_addressee (id INT AUTO_INCREMENT, clause_body_id INT NOT NULL, addressee_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, UNIQUE INDEX mapping_idx (clause_body_id, addressee_id), INDEX author_id_idx (author_id), INDEX addressee_id_idx (addressee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE clause_body (id INT AUTO_INCREMENT, content LONGTEXT, information_type_id INT, operative_phrase_id INT, public_comment LONGTEXT, parent_clause_body_id INT, root_clause_body_id INT, is_latest_clause_body TINYINT(1) DEFAULT '1', status ENUM('draft', 'review', 'reviewed', 'inactive', 'active') DEFAULT 'draft' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, INDEX root_clause_body_id_idx (root_clause_body_id), INDEX parent_clause_body_id_idx (parent_clause_body_id), INDEX information_type_id_idx (information_type_id), INDEX operative_phrase_id_idx (operative_phrase_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE clause_body_tag (id INT AUTO_INCREMENT, clause_body_id INT NOT NULL, tag_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, UNIQUE INDEX mapping_idx (clause_body_id, tag_id), INDEX author_id_idx (author_id), INDEX clause_body_id_idx (clause_body_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE clause_clause_relation (id INT AUTO_INCREMENT, type ENUM('recalls', 'closely_related') NOT NULL, clause_id INT NOT NULL, related_clause_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, UNIQUE INDEX mapping_idx (clause_id, related_clause_id, type), INDEX clause_id_idx (clause_id), INDEX related_clause_id_idx (related_clause_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE clause_information_type (id INT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE clause_operative_phrase (id INT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE clause_reservation (id INT AUTO_INCREMENT, clause_body_id INT, country_id INT, reservation LONGTEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, UNIQUE INDEX mapping_idx (clause_body_id, country_id), INDEX clause_body_id_idx (clause_body_id), INDEX country_id_idx (country_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE comment (id BIGINT AUTO_INCREMENT, record_model VARCHAR(255) NOT NULL, user_id INT, record_id BIGINT NOT NULL, author_name VARCHAR(255) NOT NULL, author_email VARCHAR(255), author_website VARCHAR(255), body LONGTEXT NOT NULL, is_delete TINYINT(1) DEFAULT '0', edition_reason LONGTEXT, reply BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX reply_idx (reply), INDEX user_id_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE comment_report (id BIGINT AUTO_INCREMENT, reason LONGTEXT NOT NULL, referer VARCHAR(255), state ENUM('valid', 'invalid', 'untreated') DEFAULT 'untreated', id_comment BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX id_comment_idx (id_comment), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;
CREATE TABLE country (id INT AUTO_INCREMENT, iso VARCHAR(3) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE country_organisation (id INT AUTO_INCREMENT, country_id INT NOT NULL, organisation_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, eff_date DATE NOT NULL, exp_date DATE, INDEX country_id_idx (country_id), INDEX organisation_id_idx (organisation_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE document (id INT AUTO_INCREMENT, name TEXT NOT NULL, slug VARCHAR(50), enforcement_date DATE, adoption_date DATE NOT NULL, code VARCHAR(255), min_ratification_count INT, is_ratified TINYINT(1), vote_url TEXT, private_comment LONGTEXT, public_comment LONGTEXT, parent_document_id INT, root_document_id INT, organisation_id INT, documenttype_id INT, document_url TEXT, clause_ordering text, status ENUM('draft', 'review', 'reviewed', 'inactive', 'active') DEFAULT 'draft' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, INDEX parent_document_id_idx (parent_document_id), INDEX organisation_id_idx (organisation_id), INDEX documenttype_id_idx (documenttype_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE document_clause_relation (id INT AUTO_INCREMENT, document_id INT NOT NULL, related_clause_body_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, UNIQUE INDEX mapping_idx (document_id, related_clause_body_id), INDEX document_id_idx (document_id), INDEX related_clause_body_id_idx (related_clause_body_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE document_document_relation (id INT AUTO_INCREMENT, type ENUM('recalls', 'closely_related') NOT NULL, document_id INT NOT NULL, related_document_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, UNIQUE INDEX mapping_idx (document_id, related_document_id, type), INDEX document_id_idx (document_id), INDEX related_document_id_idx (related_document_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE document_reservation (id INT AUTO_INCREMENT, document_id INT, country_id INT, reservation LONGTEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, UNIQUE INDEX mapping_idx (document_id, country_id), INDEX document_id_idx (document_id), INDEX country_id_idx (country_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE document_tag (id INT AUTO_INCREMENT, document_id INT NOT NULL, tag_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, UNIQUE INDEX mapping_idx (document_id, tag_id), INDEX author_id_idx (author_id), INDEX document_id_idx (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE document_type (id INT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, rank_priority INT, legal_value VARCHAR(30) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE excel_file (id INT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, is_imported TINYINT(1) DEFAULT '0' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE sf_guard_user (id INT AUTO_INCREMENT, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, type VARCHAR(255), excel_file_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME, author_id INT, INDEX is_active_idx_idx (is_active), INDEX excel_file_id_idx (excel_file_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE organisation (id INT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, slug VARCHAR(255), parent_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, INDEX parent_id_idx (parent_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE tag (id INT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, UNIQUE INDEX name_idx (name), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE tag_implication (id INT AUTO_INCREMENT, implication_type ENUM('implies', 'suggests') NOT NULL, tag_id INT NOT NULL, implied_tag_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, UNIQUE INDEX mapping_idx (tag_id, implied_tag_id), INDEX tag_id_idx (tag_id), INDEX implied_tag_id_idx (implied_tag_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE vote (id INT AUTO_INCREMENT, type ENUM('adopted without a vote', 'yes', 'no', 'abstention', 'not present', 'signed', 'ratified'), vote_date datetime, document_id INT NOT NULL, country_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, UNIQUE INDEX mapping_idx (document_id, country_id), INDEX document_id_idx (document_id), INDEX country_id_idx (country_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE sf_guard_group (id INT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE sf_guard_group_permission (group_id INT, permission_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE sf_guard_permission (id INT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE sf_guard_remember_key (id INT AUTO_INCREMENT, user_id INT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id, ip_address)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE sf_guard_user (id INT AUTO_INCREMENT, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, type VARCHAR(255), excel_file_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME, author_id INT, INDEX is_active_idx_idx (is_active), INDEX sf_guard_user_type_idx (type), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE sf_guard_user_group (user_id INT, group_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE sf_guard_user_permission (user_id INT, permission_id INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
CREATE TABLE sf_guard_user_profile (id INT AUTO_INCREMENT, user_id INT NOT NULL, email VARCHAR(80), fullname VARCHAR(80), validate VARCHAR(17), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, author_id INT, INDEX user_id_idx (user_id), INDEX author_id_idx (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 ENGINE = InnoDB;
ALTER TABLE addressee ADD CONSTRAINT addressee_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE clause ADD CONSTRAINT clause_document_id_document_id FOREIGN KEY (document_id) REFERENCES document(id);
ALTER TABLE clause ADD CONSTRAINT clause_clause_body_id_clause_body_id FOREIGN KEY (clause_body_id) REFERENCES clause_body(id);
ALTER TABLE clause ADD CONSTRAINT clause_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE clause_addressee ADD CONSTRAINT clause_addressee_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE clause_addressee ADD CONSTRAINT clause_addressee_addressee_id_addressee_id FOREIGN KEY (addressee_id) REFERENCES addressee(id);
ALTER TABLE clause_body ADD CONSTRAINT clause_body_root_clause_body_id_clause_body_id FOREIGN KEY (root_clause_body_id) REFERENCES clause_body(id);
ALTER TABLE clause_body ADD CONSTRAINT clause_body_parent_clause_body_id_clause_body_id FOREIGN KEY (parent_clause_body_id) REFERENCES clause_body(id);
ALTER TABLE clause_body ADD CONSTRAINT clause_body_operative_phrase_id_clause_operative_phrase_id FOREIGN KEY (operative_phrase_id) REFERENCES clause_operative_phrase(id);
ALTER TABLE clause_body ADD CONSTRAINT clause_body_information_type_id_clause_information_type_id FOREIGN KEY (information_type_id) REFERENCES clause_information_type(id);
ALTER TABLE clause_body ADD CONSTRAINT clause_body_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE clause_body_tag ADD CONSTRAINT clause_body_tag_clause_body_id_clause_body_id FOREIGN KEY (clause_body_id) REFERENCES clause_body(id);
ALTER TABLE clause_body_tag ADD CONSTRAINT clause_body_tag_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE clause_clause_relation ADD CONSTRAINT clause_clause_relation_related_clause_id_clause_id FOREIGN KEY (related_clause_id) REFERENCES clause(id);
ALTER TABLE clause_clause_relation ADD CONSTRAINT clause_clause_relation_clause_id_clause_id FOREIGN KEY (clause_id) REFERENCES clause(id);
ALTER TABLE clause_clause_relation ADD CONSTRAINT clause_clause_relation_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE clause_information_type ADD CONSTRAINT clause_information_type_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE clause_operative_phrase ADD CONSTRAINT clause_operative_phrase_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE clause_reservation ADD CONSTRAINT clause_reservation_country_id_country_id FOREIGN KEY (country_id) REFERENCES country(id);
ALTER TABLE clause_reservation ADD CONSTRAINT clause_reservation_clause_body_id_clause_body_id FOREIGN KEY (clause_body_id) REFERENCES clause_body(id);
ALTER TABLE clause_reservation ADD CONSTRAINT clause_reservation_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE comment ADD CONSTRAINT comment_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE comment ADD CONSTRAINT comment_reply_comment_id FOREIGN KEY (reply) REFERENCES comment(id);
ALTER TABLE comment_report ADD CONSTRAINT comment_report_id_comment_comment_id FOREIGN KEY (id_comment) REFERENCES comment(id) ON DELETE CASCADE;
ALTER TABLE country ADD CONSTRAINT country_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE country_organisation ADD CONSTRAINT country_organisation_organisation_id_organisation_id FOREIGN KEY (organisation_id) REFERENCES organisation(id);
ALTER TABLE country_organisation ADD CONSTRAINT country_organisation_country_id_country_id FOREIGN KEY (country_id) REFERENCES country(id);
ALTER TABLE country_organisation ADD CONSTRAINT country_organisation_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE document ADD CONSTRAINT document_parent_document_id_document_id FOREIGN KEY (parent_document_id) REFERENCES document(id);
ALTER TABLE document ADD CONSTRAINT document_organisation_id_organisation_id FOREIGN KEY (organisation_id) REFERENCES organisation(id);
ALTER TABLE document ADD CONSTRAINT document_documenttype_id_document_type_id FOREIGN KEY (documenttype_id) REFERENCES document_type(id);
ALTER TABLE document ADD CONSTRAINT document_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE document_clause_relation ADD CONSTRAINT document_clause_relation_related_clause_body_id_clause_body_id FOREIGN KEY (related_clause_body_id) REFERENCES clause_body(id);
ALTER TABLE document_clause_relation ADD CONSTRAINT document_clause_relation_document_id_document_id FOREIGN KEY (document_id) REFERENCES document(id);
ALTER TABLE document_clause_relation ADD CONSTRAINT document_clause_relation_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE document_document_relation ADD CONSTRAINT document_document_relation_related_document_id_document_id FOREIGN KEY (related_document_id) REFERENCES document(id);
ALTER TABLE document_document_relation ADD CONSTRAINT document_document_relation_document_id_document_id FOREIGN KEY (document_id) REFERENCES document(id);
ALTER TABLE document_document_relation ADD CONSTRAINT document_document_relation_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE document_reservation ADD CONSTRAINT document_reservation_document_id_document_id FOREIGN KEY (document_id) REFERENCES document(id);
ALTER TABLE document_reservation ADD CONSTRAINT document_reservation_country_id_country_id FOREIGN KEY (country_id) REFERENCES country(id);
ALTER TABLE document_reservation ADD CONSTRAINT document_reservation_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE document_tag ADD CONSTRAINT document_tag_document_id_document_id FOREIGN KEY (document_id) REFERENCES document(id);
ALTER TABLE document_tag ADD CONSTRAINT document_tag_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE document_type ADD CONSTRAINT document_type_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE excel_file ADD CONSTRAINT excel_file_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE sf_guard_user ADD CONSTRAINT sf_guard_user_excel_file_id_excel_file_id FOREIGN KEY (excel_file_id) REFERENCES excel_file(id);
ALTER TABLE sf_guard_user ADD CONSTRAINT sf_guard_user_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE organisation ADD CONSTRAINT organisation_parent_id_organisation_id FOREIGN KEY (parent_id) REFERENCES organisation(id);
ALTER TABLE organisation ADD CONSTRAINT organisation_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE tag ADD CONSTRAINT tag_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE tag_implication ADD CONSTRAINT tag_implication_tag_id_tag_id FOREIGN KEY (tag_id) REFERENCES tag(id);
ALTER TABLE tag_implication ADD CONSTRAINT tag_implication_implied_tag_id_tag_id FOREIGN KEY (implied_tag_id) REFERENCES tag(id);
ALTER TABLE tag_implication ADD CONSTRAINT tag_implication_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE vote ADD CONSTRAINT vote_document_id_document_id FOREIGN KEY (document_id) REFERENCES document(id);
ALTER TABLE vote ADD CONSTRAINT vote_country_id_country_id FOREIGN KEY (country_id) REFERENCES country(id);
ALTER TABLE vote ADD CONSTRAINT vote_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_profile ADD CONSTRAINT sf_guard_user_profile_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_profile ADD CONSTRAINT sf_guard_user_profile_author_id_sf_guard_user_id FOREIGN KEY (author_id) REFERENCES sf_guard_user(id);
