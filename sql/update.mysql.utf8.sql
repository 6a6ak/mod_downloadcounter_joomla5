-- Update script for existing installations
ALTER TABLE `#__download_counter` 
ADD COLUMN `title` VARCHAR(255) NULL AFTER `count`,
ADD COLUMN `file_path` VARCHAR(500) NULL AFTER `title`,
ADD COLUMN `created_date` DATETIME DEFAULT CURRENT_TIMESTAMP AFTER `file_path`,
ADD COLUMN `last_downloaded` DATETIME NULL AFTER `created_date`;

-- Insert default data for the new download items if they don't exist
INSERT IGNORE INTO `#__download_counter` (`file_id`, `count`, `title`, `file_path`, `created_date`) 
VALUES 
(1, 0, 'Download the Book', '/downloads/book.pdf', NOW()),
(2, 0, 'Download the Book2', '/downloads/book2.pdf', NOW());
