<?php
/**
 * Search Results Template
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
    <div class="breadcrumb-area pt-245 pb-255" style="background-image:url(<?php echo esc_url( $breadcrumb_bg ); ?>)">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-text text-center">
                        <h1><?php printf( __( 'Search Results for: %s', 'kingfact' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                        <ul class="breadcrumb-menu">
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">home</a></li>
                            <li><span>search results</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <!-- search-results-area start -->
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
                                        if ( has_post_thumbnail() ) {
                                            the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) );
                                        } else {
                                            echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/img/blog/default.jpg' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                                        }
                                        ?>
                                    </a>
                                </div>

                                <div class="blog-text">
                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <div class="search-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>">Read More <i class="dripicons-arrow-thin-right"></i></a>
                                    <div class="blog-meta">
                                        <span> <i class="far fa-calendar-alt"></i> <?php echo get_the_date( 'd M Y' ); ?></span>
                                        <?php if ( 'post' === get_post_type() ) : ?>
                                            <span> <a href="<?php the_permalink(); ?>#comments"><i class="far fa-comment"></i> Comments (<?php echo get_comments_number(); ?>)</a></span>
                                        <?php endif; ?>
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
                        <div class="search-no-results text-center pt-80 pb-80">
                            <h3><?php _e( 'Nothing Found', 'kingfact' ); ?></h3>
                            <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'kingfact' ); ?></p>
                            <div class="search-form-wrapper" style="max-width: 600px; margin: 30px auto 0;">
                                <?php get_search_form(); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </section>
    <!-- search-results-area end -->

</main>

<?php
get_footer();
