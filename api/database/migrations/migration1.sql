CREATE TABLE categories (
    id CHAR(36) NOT NULL DEFAULT (UUID()),    -- UUID as CHAR(36), default to UUID function
    name VARCHAR(255) NOT NULL,
    parent_id CHAR(36),                        -- Parent ID of type UUID
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,   -- Default to current timestamp
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,   -- Automatically update on change
    PRIMARY KEY (id),
    FOREIGN KEY (parent_id) REFERENCES categories(id) -- Optional: Foreign key constraint to self for hierarchical structure
);

CREATE TABLE `courses` (
    `id` CHAR(36) NOT NULL DEFAULT (UUID()),    -- UUID as CHAR(36), default to UUID function
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `image_preview` VARCHAR(255),
    `category_id` CHAR(36) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
);
