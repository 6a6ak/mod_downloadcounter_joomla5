CREATE TABLE IF NOT EXISTS `#__download_counter` (
  `file_id` INT PRIMARY KEY,
  `count` INT NOT NULL DEFAULT 0,
  `title` VARCHAR(255) NULL,
  `file_path` VARCHAR(500) NULL,
  `created_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `last_downloaded` DATETIME NULL
);