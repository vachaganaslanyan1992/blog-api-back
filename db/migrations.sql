-- Create the database
CREATE DATABASE IF NOT EXISTS blogs;

-- Use the database
USE blogs;

-- Create the `post_categories` table
CREATE TABLE IF NOT EXISTS post_categories (
    category_id INT(11) NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(255) NOT NULL UNIQUE,
    PRIMARY KEY (category_id)
    );

-- Create the `posts` table
CREATE TABLE IF NOT EXISTS posts (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    PRIMARY KEY (id)
    );

-- Create a junction table to relate posts and categories
CREATE TABLE IF NOT EXISTS post_category_relations (
    post_id INT(11) NOT NULL,
    category_id INT(11) NOT NULL,
    PRIMARY KEY (post_id, category_id),
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES post_categories(category_id) ON DELETE CASCADE
    );
