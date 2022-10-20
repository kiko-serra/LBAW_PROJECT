--Add tsvector column to post 
ALTER TABLE post
ADD COLUMN tsvectors TSVECTOR;


--Create a function to automatically update ts_vectors
CREATE FUNCTION post_tsv_update() RETURNS TRIGGER AS $$
BEGIN
  IF TG_OP = 'INSERT' THEN
      NEW.tsvectors = to_tsvector('portuguese', NEW.title);
  END IF;
  IF TG_OP = 'UPDATE' THEN
      IF NEW.description <> OLD.description THEN
          NEW.tsvectors = to_tsvector('portuguese',NEW.title);
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

--Create Index
CREATE INDEX tsv_idx ON post USING GIN(tsvectors);



--Query
SELECT id_post
FROM post
WHERE to_tsvector('english', description) @@ plainto_tsquery('english', 'leg');