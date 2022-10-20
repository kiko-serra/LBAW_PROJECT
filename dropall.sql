-- Triggers

DROP TRIGGER IF EXISTS administrator_t on relationship;
DROP FUNCTION IF EXISTS administartor_t;

DROP TRIGGER IF EXISTS friends_t ON friend_request;
DROP FUNCTION IF EXISTS friends_t();

DROP TRIGGER IF EXISTS react_once ON post_reaction;
DROP FUNCTION IF EXISTS react_once();

DROP TRIGGER IF EXISTS promotion_once ON post_promotion;
DROP FUNCTION IF EXISTS promotion_once();

DROP TRIGGER IF EXISTS post_tsv_update ON post;
DROP FUNCTION IF EXISTS post_tsv_update();

--Tables

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
DROP TABLE IF EXISTS group_table;
DROP TABLE IF EXISTS account;
