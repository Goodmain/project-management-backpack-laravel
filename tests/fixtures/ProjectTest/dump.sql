INSERT INTO users(id, name, email, password, role_id, created_at, updated_at) VALUES
  (1, 'Mr Admin', 'admin@example.com', '$2y$10$X4receiTrF24bXrEbAiChOZ8TMNPqoXuhuThgynvBdWIHZeu5HzsS', 1, '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (2, 'Another User', 'user@example.com', '$2y$10$ywtTizICfzWDTU2Cp3s.8.HIvJpGUsvi66Y.x6ByBib8O.D2fxbSK', 2, '2016-10-20 11:05:00', '2016-10-20 11:05:00');

INSERT INTO projects(id, name, description, tags, created_at, updated_at) VALUES
  (1, 'Project 1', 'Description text', '["tag1", "tag2"]', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (2, 'Project 2', 'Another description text 2', '["tag2", "tag1"]', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (3, 'Project 3', 'Text', '[]', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (4, 'Project 4', 'Text is here 1', '[]', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (5, 'Project 5', 'Something about project', '["tag1"]', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (6, 'Project 6', 'Maybe here will be the description', '["tag2"]', '2016-10-20 11:05:00', '2016-10-20 11:05:00');

INSERT INTO project_user(id, project_id, user_id) VALUES
  (1, 1, 1),
  (2, 2, 2),
  (3, 3, 1),
  (4, 4, 2),
  (5, 5, 1),
  (6, 6, 2);
