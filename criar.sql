DROP TABLE IF EXISTS friendship;
DROP TABLE IF EXISTS post_reaction;
DROP TABLE IF EXISTS post_promotion;
DROP TABLE IF EXISTS relationship;
DROP TABLE IF EXISTS post_report;
DROP TABLE IF EXISTS recovery_code;
DROP TABLE IF EXISTS notification;
DROP TABLE IF EXISTS friend_request;
DROP TABLE IF EXISTS account_report;
DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS community;
DROP TABLE IF EXISTS account;

--Tables

CREATE TABLE account (
    id_account SERIAL PRIMARY KEY,
    account_tag TEXT CONSTRAINT null_account_account_tag NOT NULL CONSTRAINT unique_account_account_tag UNIQUE,
    password TEXT CONSTRAINT null_account_password NOT NULL,
    name TEXT CONSTRAINT null_account_name NOT NULL,
    age NUMERIC(3,0) CONSTRAINT null_account_age NOT NULL CONSTRAINT check_account_age CHECK (age >= 16),
    birthday DATE CONSTRAINT null_account_birthdate NOT NULL,
    is_private BOOLEAN CONSTRAINT null_account_is_private NOT NULL,
	email TEXT CONSTRAINT null_account_email NOT NULL CONSTRAINT unique_account_email UNIQUE,
	university TEXT CONSTRAINT null_account_university NOT NULL,
	course TEXT CONSTRAINT null_account_course NOT NULL,
	is_verified BOOLEAN CONSTRAINT null_account_verified NOT NULL,
	description TEXT,
	location TEXT,
	pronouns TEXT,
	is_admin BOOLEAN CONSTRAINT null_account_is_admin NOT NULL,
	is_blocked BOOLEAN CONSTRAINT null_account_is_blocked NOT NULL
);

CREATE TABLE community (
    id_group SERIAL PRIMARY KEY,
    name TEXT CONSTRAINT null_Group_name NOT NULL,
    description TEXT,
    is_public BOOLEAN CONSTRAINT null_Group_is_public NOT NULL
);

CREATE TABLE post (
    id_post SERIAL PRIMARY KEY,
    parent_post INTEGER REFERENCES post(id_post),
    owner_id INTEGER CONSTRAINT null_Post_owner NOT NULL REFERENCES account (id_account) ON DELETE CASCADE,
    group_id INTEGER CONSTRAINT null_Post_group REFERENCES community (id_group) ON DELETE CASCADE,
    description TEXT CONSTRAINT null_Post_description NOT NULL CONSTRAINT check_Post_description CHECK (LENGTH(description) < 500 AND LENGTH(description) > 0),
    has_images BOOLEAN CONSTRAINT null_Post_has_images NOT NULL,
    publication_date TIMESTAMP(2) CONSTRAINT null_Post_date NOT NULL DEFAULT CURRENT_TIMESTAMP(2)::TIMESTAMP WITHOUT TIME ZONE,
    edited_date TIMESTAMP(2) CONSTRAINT check_Post_edited_date CHECK (edited_date <= CURRENT_TIMESTAMP(2)::TIMESTAMP WITHOUT TIME ZONE AND edited_date > publication_date),
    comments_count INTEGER CONSTRAINT null_Post_comments_count NOT NULL CONSTRAINT check_Post_is_private CHECK (comments_count >= 0),
    is_visible BOOLEAN CONSTRAINT null_Post_is_private NOT NULL
);

CREATE TABLE account_report (
    id_report SERIAL PRIMARY KEY,
    reason INTEGER CONSTRAINT null_account_report_reason NOT NULL,
    description TEXT,
	id_account_reporting INTEGER CONSTRAINT null_account_id_account_reporting NOT NULL REFERENCES account (id_account) ON DELETE CASCADE,
    id_account_reported INTEGER CONSTRAINT null_account_report_id_account_reported NOT NULL REFERENCES account (id_account) ON DELETE CASCADE
);

CREATE TABLE friend_request (
    id_sender INTEGER CONSTRAINT null_Friend_request_id_sender NOT NULL REFERENCES account (id_account) ON DELETE CASCADE,
    id_receiver INTEGER CONSTRAINT null_Friend_request_id_receiver NOT NULL REFERENCES account (id_account) ON DELETE CASCADE,
    PRIMARY KEY (id_sender, id_receiver)
);

CREATE TABLE notification (
    id_notification SERIAL PRIMARY KEY,
    id_receiver INTEGER CONSTRAINT null_Notification_id_receiver NOT NULL REFERENCES account (id_account) ON DELETE CASCADE,
    url TEXT CONSTRAINT null_Notification_url NOT NULL,
    notification_date TIMESTAMP(2) CONSTRAINT null_Notification_date NOT NULL CONSTRAINT check_Notification_date CHECK (notification_date <= CURRENT_TIMESTAMP(2)::TIMESTAMP WITHOUT TIME ZONE) DEFAULT CURRENT_TIMESTAMP(2)::TIMESTAMP WITHOUT TIME ZONE,
    description TEXT CONSTRAINT null_Notification_description NOT NULL,
    is_read BOOLEAN CONSTRAINT null_Notification_is_read NOT NULL
);

CREATE TABLE recovery_code (
    id_recovery_code SERIAL PRIMARY KEY,
    id_account INTEGER CONSTRAINT null_Recovery_code_id_account NOT NULL REFERENCES account (id_account) ON DELETE CASCADE,
    code TEXT CONSTRAINT null_Recovery_code_code NOT NULL UNIQUE,
    valid_until TIMESTAMP(2) CONSTRAINT null_Recovery_code_valid_until NOT NULL CONSTRAINT check_Recovery_code_valid_until CHECK (valid_until >= CURRENT_TIMESTAMP(2)::TIMESTAMP WITHOUT TIME ZONE) DEFAULT CURRENT_TIMESTAMP(2)::TIMESTAMP WITHOUT TIME ZONE
);

CREATE TABLE post_report (
    id_report SERIAL PRIMARY KEY,
    id_post INTEGER CONSTRAINT null_Post_report_id_post NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    reason INTEGER CONSTRAINT null_Post_report_reason NOT NULL,
    description TEXT
);

CREATE TABLE relationship (
    id_group INTEGER CONSTRAINT null_Relationship_id_group NOT NULL REFERENCES community (id_group) ON DELETE CASCADE,
    id_account INTEGER CONSTRAINT null_Relationship_account_id NOT NULL REFERENCES account (id_account) ON DELETE CASCADE,
    status TEXT CONSTRAINT null_Relationship_status NOT NULL CONSTRAINT check_Relationship_status CHECK (status = 'member' OR status = 'admin' OR status = 'pending'),
    PRIMARY KEY (id_group, id_account)
);

CREATE TABLE post_promotion (
    id_account INTEGER CONSTRAINT null_Post_promotion_id_account NOT NULL REFERENCES account (id_account) ON DELETE CASCADE,
    id_post INTEGER CONSTRAINT null_Post_promotion_id_post NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    promotion_date TIMESTAMP(2) CONSTRAINT null_Post_promotion_date NOT NULL CONSTRAINT check_Post_promotion_date CHECK (promotion_date <= CURRENT_TIMESTAMP(2)::TIMESTAMP WITHOUT TIME ZONE) DEFAULT CURRENT_TIMESTAMP(2)::TIMESTAMP WITHOUT TIME ZONE,
    PRIMARY KEY (id_account, id_post)
);

CREATE TABLE post_reaction (
    id_account INTEGER CONSTRAINT null_Post_react_id_account NOT NULL REFERENCES account (id_account) ON DELETE CASCADE,
    id_post INTEGER CONSTRAINT null_Post_react_id_post NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    react_date DATE CONSTRAINT null_Post_react_date NOT NULL CONSTRAINT check_Post_react_date CHECK (react_date <= CURRENT_TIMESTAMP(2)::TIMESTAMP WITHOUT TIME ZONE) DEFAULT CURRENT_TIMESTAMP(2)::TIMESTAMP WITHOUT TIME ZONE,
    up_vote BOOLEAN CONSTRAINT null_Post_react_up_vote NOT NULL,
    PRIMARY KEY (id_account, id_post)
);

CREATE TABLE friendship (
    account1_id INTEGER CONSTRAINT null_Friendship_account1_id NOT NULL REFERENCES account (id_account) ON DELETE CASCADE,
    account2_id INTEGER CONSTRAINT null_Friendship_account2_id NOT NULL REFERENCES account (id_account) ON DELETE CASCADE,
	CHECK (account1_id <> account2_id),
    PRIMARY KEY (account1_id, account2_id)
);