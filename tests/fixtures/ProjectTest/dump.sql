INSERT INTO roles(id, name, created_at, updated_at) VALUES
  (1, 'user', '2016-10-20 11:05:00', '2016-10-20 11:05:00');

INSERT INTO users(id, name, email, password, role_id, set_password_hash_created_at, set_password_hash, created_at, updated_at) VALUES
  (1, 'Lupe Torphy', 'gcasper@example.net', 1, 2, 1, 1, '2016-10-20 11:05:00', '2016-10-20 11:05:00');

INSERT INTO projects(id, created_at, updated_at) VALUES
  (1, '2016-10-20 11:05:00', '2016-10-20 11:05:00');

