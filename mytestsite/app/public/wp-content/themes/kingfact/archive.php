<?php
/**
 * Archive template for Blog Posts
 * This template displays the blog listing page
 */

get_header();

// Get breadcrumb background from theme options or ACF
$breadcrumb_bg = '';
if ( function_exists( 'get_field' ) ) {
    $bg_field = get_field( 'blog_breadcrumb_bg', 'option' );
    if ( $bg_field ) {
        $breadcrumb_bg = is_array( $bg_field ) ? $bg_field['url'] : $bg_field;
    }
}
if ( ! $breadcrumb_bg ) {
    $breadcrumb_bg = get_template_directory_uri() . '/assets/img/bg/bg-9.jpg';
}
?>

<main>
    <!-- breadcrumb-area-start -->
    <div class="breadcrumb-area" style="background-image:url(<?php echo esc_url( $breadcrumb_bg ); ?>); min-height: 350px; display: flex; align-items: center;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-text text-center">
                        <h1><?php 
                            if ( is_category() ) {
                                single_cat_title();
                            } elseif ( is_tag() ) {
                                single_tag_title();
                            } elseif ( is_author() ) {
                                the_author();
                            } elseif ( is_day() ) {
                                echo get_the_date();
                            } elseif ( is_month() ) {
                                echo get_the_date('F Y');
                            } elseif ( is_year() ) {
                                echo get_the_date('Y');
                            } else {
                                echo 'Blog';
                            }
                        ?></h1>
                        <ul class="breadcrumb-menu">
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">home</a></li>
                            <li><span><?php 
                                if ( is_category() ) {
                                    echo 'category';
                                } elseif ( is_tag() ) {
                                    echo 'tag';
                                } else {
                                    echo 'blog';
                                }
                            ?></span></li>
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
                                        $post_banner_url = $post_banner_id ? wp_get_attachment_image_url($post_banner_id, 'medium') : '';
                                        
                                        if ($post_banner_url) {
                                            echo '<img src="' . esc_url($post_banner_url) . '" alt="' . esc_attr(get_the_title()) . '">';
                                        } elseif (has_post_thumbnail()) {
                                            the_post_thumbnail('medium', array('alt' => get_the_title()));
                                        } else {
                                            echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/img/blog/default.jpg') . '" alt="' . esc_attr(get_the_title()) . '">';
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
