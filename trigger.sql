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

--Add tsvector column to post 
ALTER TABLE post
ADD COLUMN tsvectors TSVECTOR;

--Create a function to automatically update ts_vectors
CREATE FUNCTION post_tsv_update() RETURNS TRIGGER AS $$
BEGIN
  IF TG_OP = 'INSERT' THEN
      NEW.tsvectors = to_tsvector('portuguese', NEW.description);
  END IF;
  IF TG_OP = 'UPDATE' THEN
      IF NEW.description <> OLD.description THEN
          NEW.tsvectors = to_tsvector('portuguese',NEW.description);
      END IF;
  END IF;
  RETURN NEW;
END
$$ LANGUAGE 'plpgsql';
  
--Create a trigger
CREATE TRIGGER post_tsv_update
BEFORE INSERT OR UPDATE ON post
FOR EACH ROW
EXECUTE PROCEDURE post_tsv_update();


-- Promotion
CREATE FUNCTION promotion_once() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'UPDATE' THEN
       RAISE EXCEPTION 'Not possible to update this table';
    END IF;
    IF TG_OP = 'INSERT' THEN
       IF EXISTS (SELECT * FROM post_promotion WHERE id_account = NEW.id_account AND id_post= NEW.id_post)
           THEN RAISE EXCEPTION 'Already promoted by this user';
       END IF;
    END IF;
RETURN NEW;
END 
$$ LANGUAGE plpgsql;


CREATE TRIGGER promotion_once
BEFORE INSERT OR UPDATE ON post_promotion  
FOR EACH ROW
EXECUTE PROCEDURE promotion_once();

-- React

CREATE FUNCTION react_once() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'UPDATE' THEN
       IF  NEW.id_account <> OLD.id_account OR NEW.id_post <> OLD.id_post THEN
           RAISE EXCEPTION 'Not possible to update id_account or id_post';
       END IF;
    END IF;
    IF TG_OP = 'INSERT' THEN
       IF EXISTS (SELECT * FROM post_reaction WHERE id_account = NEW.id_account AND id_post= NEW.id_post)
           THEN RAISE EXCEPTION 'Already reacted by this user';
       END IF;
    END IF;
RETURN NEW;
END 
$$ LANGUAGE plpgsql;


CREATE TRIGGER react_once
BEFORE INSERT OR UPDATE ON post_reaction
FOR EACH ROW
EXECUTE PROCEDURE react_once();

-- Friend Request
CREATE FUNCTION friends_t() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'UPDATE' THEN
        RAISE EXCEPTION 'Cannot update this table';
    END IF;
        
    IF TG_OP = 'INSERT' THEN
        IF NEW.id_sender = NEW.id_receiver 
            THEN RAISE EXCEPTION 'Cannot request yourself';
        END IF;
            
        IF EXISTS (SELECT * FROM friend_request WHERE (id_sender = NEW.id_sender AND  id_receiver = NEW.id_receiver) OR  (id_sender = NEW.id_receiver AND  id_receiver = NEW.id_sender))
            THEN RAISE EXCEPTION 'Friend already requested';
		END IF;
            
        IF EXISTS (SELECT * FROM friendship WHERE (id_account_1 = NEW.id_account_1 AND  id_account_2 = NEW.id_account_2) OR  (id_account_1 = NEW.id_account_2 AND  id_account_2 = NEW.id_account_1))
                THEN RAISE EXCEPTION '2 users are friends';
        END IF;
    END IF;
RETURN NEW;
END 
$$ LANGUAGE plpgsql;

CREATE TRIGGER friends_t
BEFORE INSERT OR UPDATE ON friend_request  
FOR EACH ROW
EXECUTE PROCEDURE friends_t();


-- Group Administrator
CREATE FUNCTION administrator_t() RETURNS TRIGGER AS $$
BEGIN
    --UPDATE
	IF TG_OP = 'UPDATE' THEN
		IF NEW.status <> OLD.status AND OLD.status = 'admin' AND (SELECT COUNT(*) FROM relationship WHERE id_group = OLD.id_group AND status='admin') = 1
			THEN RAISE EXCEPTION 'User is the only administrator';
		END IF;
	END IF;

    --DELETE
	IF TG_OP = 'DELETE' THEN
		IF OLD.status = 'admin' AND (SELECT COUNT(*) FROM relationship WHERE id_group = OLD.id_group AND status = 'admin') = 1
			THEN RAISE EXCEPTION 'User is the only administrator';
		END IF;
	END IF;
RETURN NEW;
END 
$$ LANGUAGE plpgsql;

CREATE TRIGGER administrator_t
BEFORE INSERT ON relationship
FOR EACH ROW
EXECUTE PROCEDURE administrator_t();