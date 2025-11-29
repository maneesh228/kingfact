<?php
/**
 * Template Name: Site Map
 * Description: Template for Site Map page
 */

get_header();

// Get featured image or use default
$featured_img = '';
if (has_post_thumbnail()) {
    $featured_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
} else {
    $featured_img = get_template_directory_uri() . '/img/breadcrumb-bg.jpg';
}
?>

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area" style="background-image: url('<?php echo esc_url($featured_img); ?>');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <ul class="page-list">
                        <li><a href="<?php echo home_url('/'); ?>">Home</a></li>
                        <li><?php the_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->

<!-- Site Map Content Area Start -->
<div class="sitemap-area pd-top-120 pd-bottom-120">
    <div class="container">
        <div class="row">
            <!-- Pages Section -->
            <div class="col-lg-6 col-md-6">
                <div class="sitemap-section mb-5">
                    <h3 class="section-title mb-4">Pages</h3>
                    <ul class="sitemap-list">
                        <?php
                        $pages = get_pages(array(
                            'sort_column' => 'menu_order',
                            'sort_order' => 'ASC'
                        ));
                        foreach ($pages as $page) {
                            echo '<li><a href="' . get_page_link($page->ID) . '">' . esc_html($page->post_title) . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Blog Posts Section -->
            <div class="col-lg-6 col-md-6">
                <div class="sitemap-section mb-5">
                    <h3 class="section-title mb-4">Blog Posts</h3>
                    <ul class="sitemap-list">
                        <?php
                        $posts = get_posts(array(
                            'numberposts' => -1,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ));
                        foreach ($posts as $post) {
                            echo '<li><a href="' . get_permalink($post->ID) . '">' . esc_html($post->post_title) . '</a></li>';
                        }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Services Section -->
            <div class="col-lg-6 col-md-6">
                <div class="sitemap-section mb-5">
                    <h3 class="section-title mb-4">Services</h3>
                    <ul class="sitemap-list">
                        <?php
                        $services = get_posts(array(
                            'post_type' => 'service',
                            'numberposts' => -1,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ));
                        if ($services) {
                            foreach ($services as $service) {
                                echo '<li><a href="' . get_permalink($service->ID) . '">' . esc_html($service->post_title) . '</a></li>';
                            }
                        } else {
                            echo '<li>No services found</li>';
                        }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Products Section -->
            <div class="col-lg-6 col-md-6">
                <div class="sitemap-section mb-5">
                    <h3 class="section-title mb-4">Products</h3>
                    <ul class="sitemap-list">
                        <?php
                        $products = get_posts(array(
                            'post_type' => 'product',
                            'numberposts' => -1,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ));
                        if ($products) {
                            foreach ($products as $product) {
                                echo '<li><a href="' . get_permalink($product->ID) . '">' . esc_html($product->post_title) . '</a></li>';
                            }
                        } else {
                            echo '<li>No products found</li>';
                        }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Categories Section -->
            <div class="col-lg-6 col-md-6">
                <div class="sitemap-section mb-5">
                    <h3 class="section-title mb-4">Categories</h3>
                    <ul class="sitemap-list">
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'hide_empty' => true
                        ));
                        foreach ($categories as $category) {
                            echo '<li><a href="' . get_category_link($category->term_id) . '">' . esc_html($category->name) . ' (' . $category->count . ')</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Tags Section -->
            <div class="col-lg-6 col-md-6">
                <div class="sitemap-section mb-5">
                    <h3 class="section-title mb-4">Tags</h3>
                    <ul class="sitemap-list">
                        <?php
                        $tags = get_tags(array(
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'hide_empty' => true
                        ));
                        if ($tags) {
                            foreach ($tags as $tag) {
                                echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . esc_html($tag->name) . ' (' . $tag->count . ')</a></li>';
                            }
                        } else {
                            echo '<li>No tags found</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Site Map Content Area End -->

<style>
.sitemap-section {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 5px;
}

.sitemap-section .section-title {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    border-bottom: 2px solid #ff5e14;
    padding-bottom: 10px;
}

.sitemap-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sitemap-list li {
    padding: 8px 0;
    border-bottom: 1px solid #e0e0e0;
}

.sitemap-list li:last-child {
    border-bottom: none;
}

.sitemap-list li a {
    color: #666;
    text-decoration: none;
    transition: all 0.3s ease;
    display: block;
    padding-left: 20px;
    position: relative;
}

.sitemap-list li a:before {
    content: "\f105";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    position: absolute;
    left: 0;
    color: #ff5e14;
}

.sitemap-list li a:hover {
    color: #ff5e14;
    padding-left: 25px;
}
</style>

<?php get_footer(); ?>
