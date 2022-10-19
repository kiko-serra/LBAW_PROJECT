INSERT INTO account (account_tag, password, name, age, birthday, is_private, email, university, course, is_verified, description, location, pronouns, is_admin, is_blocked)
VALUES
 ('AvilaAndre', 'pg!password', 'André Ávila', 20, '2002-07-01', false, 'up202006767@edu.fe.up.pt', 'Faculdade de Engenharia da Universidade do Porto', 'Engenharia Informática e Computação', true, 'Olá, bem-vindo à minha página!', 'Porto', 'He/Him', true, false),
 ('rspencock0', '3MYlqie', 'Rickert Spencock', 16, '1983-06-03', false, 'rspencock0@java.com', 'Tarim University', 'Dakota', false, 'Peritoneal suture', 'Santa Catalina', 'Diablo', false, false),
 ('fo1', 'IKYukrzIy', 'Felike O'' Liddy', 20, '1977-03-25', true, 'fo1@wikia.com', 'Wenzhou University', 'PT Cruiser', false, 'Anterior chamber op NEC', 'Qianhong', 'Avalon', false, false),
 ('gwhilder2', 'RHgQE5FU', 'Ginny Whilder', 23, '1972-09-13', true, 'gwhilder2@technorati.com', 'Hirosaki University', 'Yukon XL 1500', true, 'Lacrimal punctum probe', 'Cipatujah', 'Rondo', true, false),
 ('nratt3', 'OWZlLLjIz', 'Nedda Ratt', 24, '1983-07-05', true, 'nratt3@weebly.com', 'Hogeschool Rotterdam', 'Pathfinder', false, 'Opn rep umb hrn-grft NEC', 'Asprángeloi', 'Fox', false, false),
 ('aroache4', 'HKBpHqT5', 'Alano Roache', 25, '1998-09-27', true, 'aroache4@redcross.org', 'Pacific College of Oriental Medicine', 'Z8', true, 'Lap bi dr/ind ing hrn-gr', 'Muaralembu', 'Sequoia', false, true),
 ('svidineev5', 'JodahnBzO9', 'Stephannie Vidineev', 26, '1973-10-12', false, 'svidineev5@pbs.org', 'Korea University', 'Grand Prix', true, 'Colostomy NOS', 'Saransk', 'Lumina', false, false),
 ('babbatini6', 'GJs0uHzo', 'Bartholomeo Abbatini', 17, '1996-03-02', false, 'babbatini6@yelp.com', 'Colgate University', 'Stratus', true, 'Injct/infus glucarpidase', 'Humaitá', 'Minx Magnificent', false, false),
 ('alongdon7', 'MCglkP3hH', 'Aluino Longdon', 18, '1980-04-29', true, 'alongdon7@usgs.gov', 'Indiana Institute of Technologyy', 'Milan', false, 'Thorac var v lig-strip', 'Luxi', '300SE', false, false),
 ('vingleson8', '9bdWxT', 'Vivi Ingleson', 19, '1993-01-21', true, 'vingleson8@ow.ly', 'NTI University', 'Intrepid', true, 'Vasc proc revision NEC', 'Xiaoshi', 'TL', false, true),
 ('efarnaby9', 'zFMGF4WFl6Wq', 'Everett Farnaby', 19, '1986-04-11', false, 'efarnaby9@51.la', 'Kosin University', 'Expo LRV', false, 'Perianal biopsy', 'Besançon', 'S60', false, true);


INSERT INTO group_table (name, description, is_public)
VALUES
  ('LBAW22/23', 'Grupo dedicado a Laboratório de Bases de Dados e Aplicações Web.', true),
  ('Grupo3RCOM', 'Grupo 3 para o projeto de RCOM.', true);


INSERT INTO post (id_post, parent_post, owner_id, group_id, description, has_images, publication_date, edited_date, comments_count, is_visible)
VALUES
  (1, null, 5, null, 'Occ of rail trn/veh injured by fall in rail trn/veh, init', false, '2021-06-26', '2022-08-29', 0, true),
  (2, null, 1, null, 'Nondisp Maisonneuve''s fx r leg, subs for clos fx w nonunion', true, '2021-12-13', '2022-09-24', 0, false),
  (3, 1, 1, 1, 'Corrosion of third degree of back of left hand, sequela', false, '2021-07-01', '2022-01-25', 0, true),
  (4, null, 6, null, 'Lobar pneumonia, unspecified organism', false, '2022-06-01', '2022-09-22', 0, false);
-- CREATE INDEX user_work ON "user" USING btree (id);
-- CLUSTER "user" USING user_work;