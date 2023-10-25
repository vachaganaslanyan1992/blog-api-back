-- Insert sample categories
INSERT INTO post_categories (category_name) VALUES
                                                ('General'),
                                                ('Introduction'),
                                                ('Updates'),
                                                ('Tips'),
                                                ('Guide');

-- Insert sample posts
INSERT INTO posts (title, content) VALUES
                                       ('First Post', 'This is the content of the first post.'),
                                       ('Second Post', 'This is the content of the second post.'),
                                       ('Third Post', 'This is the content of the third post.');

-- Associate posts with categories
INSERT INTO post_category_relations (post_id, category_id) VALUES
                                                               (1, 1),  -- First post with 'General'
                                                               (1, 2),  -- First post with 'Introduction'
                                                               (2, 1),  -- Second post with 'General'
                                                               (2, 3),  -- Second post with 'Updates'
                                                               (3, 4),  -- Third post with 'Tips'
                                                               (3, 5);  -- Third post with 'Guide'