<?php
/**
 * Blog Setup Helper
 * 
 * This file helps you set up initial blog posts and configure blog settings.
 * Access this file ONCE by going to: http://yourdomain.com/wp-content/themes/kingfact/blog-setup.php
 * 
 * IMPORTANT: Delete this file after running it!
 */

// Load WordPress
require_once('../../../../../wp-load.php');

// Check if user is logged in and is admin
if (!is_user_logged_in() || !current_user_can('administrator')) {
    wp_die('You must be logged in as an administrator to run this setup.');
}

// Check if setup has already been run
if (get_option('kingfact_blog_setup_complete')) {
    echo '<h1>Blog Setup Already Complete</h1>';
    echo '<p>The blog setup has already been run. If you want to run it again, delete the option "kingfact_blog_setup_complete" from the database.</p>';
    echo '<p><a href="' . admin_url() . '">Go to WordPress Admin</a></p>';
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Kingfact Blog Setup</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f0f0f0;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #1a1a1a;
            border-bottom: 3px solid #f7b61a;
            padding-bottom: 10px;
        }
        .success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            background: #f7b61a;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 10px 10px 0;
        }
        .button:hover {
            background: #1a1a1a;
        }
        ul {
            line-height: 2;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Kingfact Blog Setup</h1>
        
        <?php
        if (isset($_POST['run_setup'])) {
            // Create sample blog posts
            $sample_posts = array(
                array(
                    'title' => 'Monthly Web Development Was WebP State Of Low Stress',
                    'content' => '<p>Welcome to our blog! This is a sample post to demonstrate how blog posts will look on your site. You can edit or delete this post and create your own content.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

<h2>Why This Matters</h2>

<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>',
                    'category' => 'Web Development',
                    'tags' => array('development', 'web', 'technology'),
                ),
                array(
                    'title' => 'Web Performance For Third Party Scripts SmashingConf Videos',
                    'content' => '<p>Performance is crucial for modern websites. In this post, we explore best practices for optimizing third-party scripts and improving overall site performance.</p>

<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>

<h2>Key Takeaways</h2>

<ul>
<li>Minimize third-party script usage</li>
<li>Load scripts asynchronously when possible</li>
<li>Monitor performance metrics regularly</li>
<li>Use modern optimization techniques</li>
</ul>

<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>',
                    'category' => 'Performance',
                    'tags' => array('performance', 'optimization', 'web'),
                ),
                array(
                    'title' => 'User Experience Psychology And Performance Smas Videos',
                    'content' => '<p>Understanding user psychology is essential for creating effective and engaging web experiences. This post delves into the intersection of UX and psychology.</p>

<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>

<h2>Understanding Your Users</h2>

<p>Similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>

<blockquote>Great design is invisible. It focuses on the user\'s needs and creates seamless experiences.</blockquote>

<p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>',
                    'category' => 'User Experience',
                    'tags' => array('ux', 'psychology', 'design'),
                ),
            );

            $created_posts = array();
            
            foreach ($sample_posts as $post_data) {
                // Check if category exists, create if not
                $category = get_term_by('name', $post_data['category'], 'category');
                if (!$category) {
                    $category = wp_insert_term($post_data['category'], 'category');
                    $category_id = $category['term_id'];
                } else {
                    $category_id = $category->term_id;
                }
                
                // Create the post
                $post_id = wp_insert_post(array(
                    'post_title'    => $post_data['title'],
                    'post_content'  => $post_data['content'],
                    'post_status'   => 'publish',
                    'post_type'     => 'post',
                    'post_category' => array($category_id),
                ));
                
                if ($post_id) {
                    // Add tags
                    wp_set_post_tags($post_id, $post_data['tags']);
                    $created_posts[] = $post_id;
                }
            }
            
            // Create a "Blog" page if it doesn't exist
            $blog_page = get_page_by_title('Blog');
            if (!$blog_page) {
                $blog_page_id = wp_insert_post(array(
                    'post_title'   => 'Blog',
                    'post_content' => '',
                    'post_status'  => 'publish',
                    'post_type'    => 'page',
                ));
                
                // Set as posts page
                update_option('page_for_posts', $blog_page_id);
            }
            
            // Mark setup as complete
            update_option('kingfact_blog_setup_complete', true);
            
            ?>
            <div class="success">
                <h2>✅ Setup Complete!</h2>
                <p>Your blog has been successfully set up with:</p>
                <ul>
                    <li><strong><?php echo count($created_posts); ?> sample blog posts</strong> created</li>
                    <li><strong>Categories</strong> configured</li>
                    <li><strong>Tags</strong> added</li>
                    <li><strong>Blog page</strong> created and set as posts page</li>
                </ul>
            </div>
            
            <div class="warning">
                <p><strong>⚠️ Important:</strong> Please delete this file (<code>blog-setup.php</code>) from your theme directory for security reasons.</p>
            </div>
            
            <a href="<?php echo admin_url('edit.php'); ?>" class="button">View Blog Posts</a>
            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="button">View Blog Page</a>
            <a href="<?php echo admin_url(); ?>" class="button">Go to Dashboard</a>
            
            <?php
        } else {
            ?>
            <p>This setup wizard will help you get started with the blog functionality by:</p>
            <ul>
                <li>Creating 3 sample blog posts</li>
                <li>Setting up categories and tags</li>
                <li>Creating a "Blog" page</li>
                <li>Configuring WordPress to use the blog page</li>
            </ul>
            
            <div class="warning">
                <p><strong>Note:</strong> This is a one-time setup. After running this, you should delete this file for security.</p>
            </div>
            
            <form method="post">
                <button type="submit" name="run_setup" class="button">Run Blog Setup</button>
                <a href="<?php echo admin_url(); ?>" class="button" style="background: #666;">Cancel</a>
            </form>
            <?php
        }
        ?>
    </div>
</body>
</html>
