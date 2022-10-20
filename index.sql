DROP INDEX IF EXISTS tsv_idx;
DROP INDEX IF EXISTS post_owner_date_idx;
DROP INDEX IF EXISTS post_date_idx;
DROP INDEX IF EXISTS account_tag;

--Indexes

CREATE INDEX account_tag ON account USING hash(account_tag);

CREATE INDEX post_date_idx ON post USING btree(publication_date);

CREATE INDEX post_owner_date_idx ON post USING BTREE(owner_id, publication_date);

--Full text search trigger

CREATE INDEX tsv_idx ON post USING GIN(tsvectors);