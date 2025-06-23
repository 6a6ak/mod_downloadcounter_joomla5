CREATE TABLE IF NOT EXISTS `#__download_counter` (
  `file_id` INT PRIMARY KEY,
  `count` INT NOT NULL DEFAULT 0
);