CREATE TABLE IF NOT EXISTS members
(
  user VARCHAR(32),
  pass VARCHAR(32),
  INDEX(user(6))
);
CREATE TABLE IF NOT EXISTS messages
(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  author VARCHAR(32),
  recipient VARCHAR(16),
  pm CHAR(1),
  time INT UNSIGNED,
  message VARCHAR(4096),
  INDEX(author(6)),
  INDEX(recipient(6))
);
CREATE TABLE IF NOT EXISTS friends
(
  user VARCHAR(32),
  friend VARCHAR(32),
  INDEX(user(6)),
  INDEX (friend(6))
);
CREATE TABLE IF NOT EXISTS profiles
(
  user VARCHAR(32),
  text VARCHAR(4096),
  INDEX(user(6))
);
