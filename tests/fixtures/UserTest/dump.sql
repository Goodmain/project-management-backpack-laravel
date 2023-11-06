INSERT INTO users(id, name, email, password, role_id, created_at, updated_at) VALUES
  (1, 'Mr Admin', 'admin@example.com', '$2y$10$X4receiTrF24bXrEbAiChOZ8TMNPqoXuhuThgynvBdWIHZeu5HzsS', 1, '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (2, 'Another User', 'user@example.com', '$2y$10$ywtTizICfzWDTU2Cp3s.8.HIvJpGUsvi66Y.x6ByBib8O.D2fxbSK', 2, '2016-10-20 11:05:00', '2016-10-20 11:05:00');

INSERT INTO media(id, name, owner_id, is_public, link, meta, created_at, updated_at, deleted_at) VALUES
  (1, 'Product main photo', 1 , true, 'http://localhost/test.jpg', '{}', '2016-10-20 11:05:00', '2016-10-20 11:05:00', null),
  (2, 'Category Photo photo', 1, false, 'http://localhost/test1.jpg', '{}', '2016-10-20 11:05:00', '2016-10-20 11:05:00', null),
  (3, 'Deleted photo', 2, true, 'http://localhost/test3.jpg', '{}', '2016-10-20 11:05:00', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (4, 'Photo', 2, true, 'http://localhost/test4.jpg', '{}', '2016-10-20 11:05:00', '2016-10-20 11:05:00', null);

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

INSERT INTO tasks(id, name, description, project_id, user_id, status, created_at, updated_at) VALUES
  (1, 'Product main photo', 'Description about the task 1', 1, null, 'todo', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (2, 'Change the description', 'Change the description of project', 1, 1, 'in_progress', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (3, 'Update project 1', 'Add more info', 1, null, 'done', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (4, 'Assign user', 'Assign user 3', 1, 1, 'in_progress', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (5, 'Find a new client', 'We need to find more clients', 2, 2, 'todo', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (6, 'Close all tasks', 'All tasks should be closed until Monday', 2, 2, 'todo', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (7, 'Start new project', 'We should begin something new', 3, 1, 'todo', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (8, 'Find five more clients', 'Better to find six', 3, 2, 'in_progress', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (9, 'Pay for the project', 'Use wire payment', 3, 2, 'done', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (10, 'Sell product', 'Sell more products', 4, null, 'done', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (11, 'Close the project', 'Just close it', 5, 1, 'in_progress', '2016-10-20 11:05:00', '2016-10-20 11:05:00');