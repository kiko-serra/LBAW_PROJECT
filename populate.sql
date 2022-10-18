INSERT INTO "user" (user_tag, password, name, age, birthday, is_private, email, university, course, verified, description, location, pronouns, is_admin, is_blocked)
VALUES
 ('rspencock0', '3MYlqie', 'Rickert Spencock', 1, '1983-06-03', false, 'rspencock0@java.com', 'Tarim University', 'Dakota', false, 'Peritoneal suture', 'Santa Catalina', 'Diablo', false, false),
 ('fo1', 'IKYukrzIy', 'Felike O'' Liddy', 2, '1977-03-25', true, 'fo1@wikia.com', 'Wenzhou University', 'PT Cruiser', false, 'Anterior chamber op NEC', 'Qianhong', 'Avalon', true, false),
 ('gwhilder2', 'RHgQE5FU', 'Ginny Whilder', 3, '1972-09-13', true, 'gwhilder2@technorati.com', 'Hirosaki University', 'Yukon XL 1500', true, 'Lacrimal punctum probe', 'Cipatujah', 'Rondo', true, false),
 ('nratt3', 'OWZlLLjIz', 'Nedda Ratt', 4, '1983-07-05', true, 'nratt3@weebly.com', 'Hogeschool Rotterdam', 'Pathfinder', false, 'Opn rep umb hrn-grft NEC', 'Asprángeloi', 'Fox', false, false),
 ('aroache4', 'HKBpHqT5', 'Alano Roache', 5, '1998-09-27', true, 'aroache4@redcross.org', 'Pacific College of Oriental Medicine', 'Z8', true, 'Lap bi dr/ind ing hrn-gr', 'Muaralembu', 'Sequoia', false, true),
 ('svidineev5', 'JodahnBzO9', 'Stephannie Vidineev', 6, '1973-10-12', false, 'svidineev5@pbs.org', 'Korea University', 'Grand Prix', true, 'Colostomy NOS', 'Saransk', 'Lumina', true, false),
 ('babbatini6', 'GJs0uHzo', 'Bartholomeo Abbatini', 7, '1996-03-02', false, 'babbatini6@yelp.com', 'Colgate University', 'Stratus', true, 'Injct/infus glucarpidase', 'Humaitá', 'Minx Magnificent', true, true),
 ('alongdon7', 'MCglkP3hH', 'Aluino Longdon', 8, '1980-04-29', true, 'alongdon7@usgs.gov', 'Indiana Institute of Technologyy', 'Milan', false, 'Thorac var v lig-strip', 'Luxi', '300SE', true, false),
 ('vingleson8', '9bdWxT', 'Vivi Ingleson', 9, '1993-01-21', true, 'vingleson8@ow.ly', 'NTI University', 'Intrepid', true, 'Vasc proc revision NEC', 'Xiaoshi', 'TL', true, true),
 ('efarnaby9', 'zFMGF4WFl6Wq', 'Everett Farnaby', 10, '1986-04-11', false, 'efarnaby9@51.la', 'Kosin University', 'Expo LRV', false, 'Perianal biopsy', 'Besançon', 'S60', false, true);


-- CREATE INDEX user_work ON "user" USING btree (id);
-- CLUSTER "user" USING user_work;