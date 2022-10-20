--Query
SELECT id_post
FROM post
WHERE to_tsvector('english', description) @@ plainto_tsquery('english', 'leg');