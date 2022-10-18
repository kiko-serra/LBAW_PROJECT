CREATE TABLE "user" (
    id_user INTEGER PRIMARY KEY AUTOINCREMENT,
    user_tag TEXT CONSTRAINT null_User_user_tag NOT NULL CONSTRAINT unique_User_user_tag UNIQUE,
    password TEXT CONSTRAINT null_User_password NOT NULL,
    name TEXT CONSTRAINT null_User_name NOT NULL,
    age NUMBER CONSTRAINT null_User_age NOT NULL CONSTRAINT check_User_age CHECK ( AGE >= 16),
    birthday DATE CONSTRAINT null_User_birthdate NOT NULL,
    is_private BOOLEAN CONSTRAINT null_User_is_private NOT NULL,
	email TEXT CONSTRAINT null_User_email NOT NULL CONSTRAINT unique_User_email UNIQUE,
	university TEXT CONSTRAINT null_User_university NOT NULL,
	course TEXT CONSTRAINT null_User_course NOT NULL,
	verified BOOLEAN CONSTRAINT null_User_verified NOT NULL,
	description TEXT,
	location TEXT,
	pronouns TEXT,
	is_admin BOOLEAN CONSTRAINT null_User_is_admin NOT NULL,
	is_blocked BOOLEAN CONSTRAINT null_User_is_blocked NOT NULL
);

CREATE TABLE "post" (
    id_post INTEGER PRIMARY KEY AUTOINCREMENT,
    parent_post INTEGER,
    owner   INTEGER CONSTRAINT null_Post_owner NOT NULL REFERENCES "user" (id_user),
    group  INTEGER CONSTRAINT null_Post_group NOT NULL REFERENCES "group" (id_group),
    description TEXT CONSTRAINT null_Post_description NOT NULL CONSTRAINT check_Post_description CHECK ( LENGTH(description) < 500 AND LENGTH(description) > 0),
    has_images BOOLEAN CONSTRAINT null_Post_has_images NOT NULL,
    date DATE CONSTRAINT null_Post_date NOT NULL CONSTRAINT check_Post_date CHECK ( date >= NOW),
    edited_date DATE CONSTRAINT check_Post_edited_date CHECK ( edited_date < NOW AND edited_date > date),
    comments_count INTEGER CONSTRAINT null_Post_comments_count NOT NULL CONSTRAINTS check_Post_is_private CHECK (comments_count >= 0,
    is_visible BOOLEAN CONSTRAINT null_Post_is_private NOT NULL
);

CREATE TABLE "group"(
    id_group INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT CONSTRAINT null_Group_name NOT NULL,
    description TEXT,
    is_public BOOLEAN CONSTRAINT null_Group_is_public NOT NULL
);

CREATE TABLE "friend_request" (
    sender_id INTEGER CONSTRAINT null_Friend_request_sender_id NOT NULL REFERENCES "user" (id_user),
    receiver_id INTEGER CONSTRAINT null_Friend_request_receiver_id NOT NULL REFERENCES "user" (id_user),
    PRIMARY KEY (sender_id, receiver_id)
);