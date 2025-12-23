<?php
/**
 * Template for displaying blog post listing (index/blog home)
 */

get_header();

// Get the ID of the page set as "Posts page" in Settings > Reading
$posts_page_id = get_option('page_for_posts');

// Get ACF fields for blog page
$banner_image = '';
$banner_title = 'Blog';
$breadcrumb_home = 'home';
$breadcrumb_current = 'blog';

if ($posts_page_id && function_exists('get_field')) {
    $banner_image = get_field('blog_page_banner_image', $posts_page_id);
    $banner_title_field = get_field('blog_page_banner_title', $posts_page_id);
    $breadcrumb_home_field = get_field('blog_page_breadcrumb_home', $posts_page_id);
    $breadcrumb_current_field = get_field('blog_page_breadcrumb_current', $posts_page_id);
    
    if ($banner_title_field) {
        $banner_title = $banner_title_field;
    } elseif ($posts_page_id) {
        $banner_title = get_the_title($posts_page_id);
    }
    
    if ($breadcrumb_home_field) {
        $breadcrumb_home = $breadcrumb_home_field;
    }
    
    if ($breadcrumb_current_field) {
        $breadcrumb_current = $breadcrumb_current_field;
    } elseif ($posts_page_id) {
        $breadcrumb_current = get_the_title($posts_page_id);
    }
}

// Fallback to default banner image if not set
if (!$banner_image) {
    $banner_image = get_template_directory_uri() . '/assets/img/bg/bg-9.jpg';
}
?>

<main>
    <!-- breadcrumb-area-start -->
    <div class="breadcrumb-area" style="background-image:url(<?php echo esc_url($banner_image); ?>); min-height: 350px; display: flex; align-items: center;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-text text-center">
                        <h1><?php echo esc_html($banner_title); ?></h1>
                        <ul class="breadcrumb-menu">
                            <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($breadcrumb_home); ?></a></li>
                            <li><span><?php echo esc_html($breadcrumb_current); ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- blog-area start -->
    <section class="blog-area pt-120 pb-80">
        <div class="container">
            <div class="row">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        ?>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="blog-wrapper mb-30">
                                <div class="blog-img">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php 
                                        $post_banner_id = get_post_meta(get_the_ID(), '_post_banner', true);
                                        $post_banner_url = $post_banner_id ? wp_get_attachment_image_url($post_banner_id, 'large') : '';
                                        
                                        if ($post_banner_url) {
                                            echo '<img src="' . esc_url($post_banner_url) . '" alt="' . esc_attr(get_the_title()) . '" class="img-fluid">';
                                        } elseif (has_post_thumbnail()) {
                                            the_post_thumbnail('large', array(
                                                'alt' => get_the_title(),
                                                'class' => 'img-fluid'
                                            ));
                                        } else {
                                            echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/img/blog/blog-01.jpg') . '" alt="' . esc_attr(get_the_title()) . '" class="img-fluid">';
                                        }
                                        ?>
                                    </a>
                                </div>

                                <div class="blog-text">
                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <a href="<?php the_permalink(); ?>">Read More <i class="dripicons-arrow-thin-right"></i></a>
                                    <div class="blog-meta">
                                        <span> <i class="far fa-calendar-alt"></i> <?php echo get_the_date( 'd M Y' ); ?></span>
                                        <span> <a href="<?php the_permalink(); ?>#comments"><i class="far fa-comment"></i> Comments (<?php echo get_comments_number(); ?>)</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    ?>
                </div><!-- .row -->

                <!-- Pagination -->
                <div class="row">
                    <div class="col-12">
                        <div class="basic-pagination basic-pagination-2 text-center mt-20">
                            <?php
                            the_posts_pagination( array(
                                'mid_size'  => 2,
                                'prev_text' => '<i class="fas fa-angle-left"></i>',
                                'next_text' => '<i class="fas fa-angle-right"></i>',
                            ) );
                            ?>
                        </div>
                    </div>
                <?php
                else :
                    ?>
                    <div class="col-12">
                        <div class="text-center pt-80 pb-80">
                            <h3>No posts found</h3>
                            <p>Sorry, but nothing matched your search criteria. Please try again with different keywords.</p>
                        </div>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </section>
    <!-- blog-area end -->

</main>

<?php
get_footer();
