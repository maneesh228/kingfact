-- SQL commands to update WordPress site URLs
-- Run these in your cPanel phpMyAdmin or MySQL client

UPDATE wp_options SET option_value = 'https://www.ottathycal.com/demo' WHERE option_name = 'siteurl';
UPDATE wp_options SET option_value = 'https://www.ottathycal.com/demo' WHERE option_name = 'home';

-- Also update any post content that might have the old URL
UPDATE wp_posts SET post_content = REPLACE(post_content, 'https://www.ottathycal.com/demo/app/public', 'https://www.ottathycal.com/demo');
UPDATE wp_posts SET guid = REPLACE(guid, 'https://www.ottathycal.com/demo/app/public', 'https://www.ottathycal.com/demo');
UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'https://www.ottathycal.com/demo/app/public', 'https://www.ottathycal.com/demo');
