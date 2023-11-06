INSERT INTO users(id, name, email, password, role_id, created_at, updated_at) VALUES
  (1, 'Mr Admin', 'admin@example.com', '$2y$10$X4receiTrF24bXrEbAiChOZ8TMNPqoXuhuThgynvBdWIHZeu5HzsS', 1, '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (2, 'Another User', 'user@example.com', '$2y$10$ywtTizICfzWDTU2Cp3s.8.HIvJpGUsvi66Y.x6ByBib8O.D2fxbSK', 2, '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (3, 'Another one User', 'user1@example.com', '$2y$10$ywtTizICfzWDTU2Cp3s.8.HIvJpGUsvi66Y.x6ByBib8O.D2fxbSK', 2, '2016-10-20 11:05:00', '2016-10-20 11:05:00');

INSERT INTO labels(id, name, created_at, updated_at) VALUES
  (1, 'Label 1', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (2, 'Label 2', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (3, 'Label 3', '2016-10-20 11:05:00', '2016-10-20 11:05:00'),
  (4, 'Label 4', '2016-10-20 11:05:00', '2016-10-20 11:05:00');

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
  (4, 3, 2),
  (5, 4, 2),
  (6, 5, 1),
  (7, 6, 2);

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

INSERT INTO label_task(id, label_id, task_id) VALUES
  (1, 1, 1),
  (2, 3, 1),
  (3, 4, 2),
  (4, 2, 2),
  (5, 1, 3),
  (6, 2, 3),
  (7, 2, 4),
  (8, 4, 4),
  (9, 3, 5),
  (10, 1, 7),
  (11, 1, 8),
  (12, 2, 8),
  (13, 3, 8),
  (14, 2, 9),
  (15, 3, 9),
  (16, 1, 10),
  (17, 2, 10),
  (18, 3, 10),
  (19, 4, 10),
  (20, 2, 11),
  (21, 4, 11);