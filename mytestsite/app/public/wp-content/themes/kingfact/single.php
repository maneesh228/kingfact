<?php
/**
 * Single Post Template
 * Displays individual blog post with full content
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
    <?php while ( have_posts() ) : the_post(); ?>
        
        <!-- breadcrumb-area-start -->
        <div class="breadcrumb-area" style="background-image:url(<?php echo esc_url( $breadcrumb_bg ); ?>); min-height: 350px; display: flex; align-items: center;">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-text text-center">
                            <h1><?php the_title(); ?></h1>
                            <ul class="breadcrumb-menu">
                                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">home</a></li>
                                <li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">blog</a></li>
                                <li><span><?php the_title(); ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb-area-end -->

        <!-- blog-details-area start -->
        <section class="blog-area pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8">
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-details-wrapper mb-30' ); ?>>
                            
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="blog-details-img mb-45">
                                    <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
                                </div>
                            <?php endif; ?>

                            <div class="blog-details-content">
                                <div class="blog-meta mb-20">
                                    <span><i class="far fa-user"></i> By <?php the_author(); ?></span>
                                    <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date( 'd M Y' ); ?></span>
                                    <span><i class="far fa-comment"></i> Comments (<?php echo get_comments_number(); ?>)</span>
                                    <?php
                                    $categories = get_the_category();
                                    if ( ! empty( $categories ) ) {
                                        echo '<span><i class="far fa-folder"></i> ';
                                        foreach ( $categories as $category ) {
                                            echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
                                            if ( $category !== end( $categories ) ) {
                                                echo ', ';
                                            }
                                        }
                                        echo '</span>';
                                    }
                                    ?>
                                </div>

                                <div class="blog-details-text">
                                    <?php the_content(); ?>
                                    
                                    <?php
                                    wp_link_pages( array(
                                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'kingfact' ) . '</span>',
                                        'after'       => '</div>',
                                        'link_before' => '<span>',
                                        'link_after'  => '</span>',
                                    ) );
                                    ?>
                                </div>

                                <?php
                                // Tags
                                $tags = get_the_tags();
                                if ( $tags ) : ?>
                                    <div class="blog-details-tags mt-40 mb-40">
                                        <h5>Tags:</h5>
                                        <div class="tag-list">
                                            <?php foreach ( $tags as $tag ) : ?>
                                                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Social Share -->
                                <div class="blog-details-share mb-40">
                                    <h5>Share this post:</h5>
                                    <div class="share-links">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a>
                                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink() ); ?>&title=<?php echo urlencode( get_the_title() ); ?>" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&body=<?php echo urlencode( get_permalink() ); ?>" target="_blank"><i class="far fa-envelope"></i></a>
                                    </div>
                                </div>

                                <!-- Author Box -->
                                <div class="author-box mb-50">
                                    <div class="author-img">
                                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
                                    </div>
                                    <div class="author-text">
                                        <h5><?php the_author(); ?></h5>
                                        <p><?php echo get_the_author_meta( 'description' ); ?></p>
                                    </div>
                                </div>

                                <!-- Post Navigation -->
                                <div class="post-navigation mb-50">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                            $prev_post = get_previous_post();
                                            if ( $prev_post ) : ?>
                                                <div class="prev-post">
                                                    <span class="nav-label"><i class="fas fa-angle-left"></i> Previous Post</span>
                                                    <h6><a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>"><?php echo esc_html( $prev_post->post_title ); ?></a></h6>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <?php
                                            $next_post = get_next_post();
                                            if ( $next_post ) : ?>
                                                <div class="next-post">
                                                    <span class="nav-label">Next Post <i class="fas fa-angle-right"></i></span>
                                                    <h6><a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php echo esc_html( $next_post->post_title ); ?></a></h6>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Comments -->
                                <?php
                                if ( comments_open() || get_comments_number() ) {
                                    comments_template();
                                }
                                ?>

                            </div>
                        </article>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-xl-4 col-lg-4">
                        <aside class="blog-sidebar">
                            
                            <!-- Search Widget -->
                            <div class="widget mb-40">
                                <h3 class="widget-title">Search</h3>
                                <div class="widget-search">
                                    <?php get_search_form(); ?>
                                </div>
                            </div>

                            <!-- Categories Widget -->
                            <div class="widget mb-40">
                                <h3 class="widget-title">Categories</h3>
                                <ul class="widget-categories">
                                    <?php
                                    wp_list_categories( array(
                                        'title_li' => '',
                                        'show_count' => true,
                                    ) );
                                    ?>
                                </ul>
                            </div>

                            <!-- Recent Posts Widget -->
                            <div class="widget mb-40">
                                <h3 class="widget-title">Recent Posts</h3>
                                <ul class="widget-recent-posts">
                                    <?php
                                    $recent_posts = wp_get_recent_posts( array(
                                        'numberposts' => 5,
                                        'post_status' => 'publish',
                                    ) );
                                    foreach ( $recent_posts as $recent ) :
                                        ?>
                                        <li>
                                            <div class="recent-post-item">
                                                <?php if ( has_post_thumbnail( $recent['ID'] ) ) : ?>
                                                    <div class="recent-post-img">
                                                        <a href="<?php echo esc_url( get_permalink( $recent['ID'] ) ); ?>">
                                                            <?php echo get_the_post_thumbnail( $recent['ID'], 'thumbnail' ); ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="recent-post-text">
                                                    <h6><a href="<?php echo esc_url( get_permalink( $recent['ID'] ) ); ?>"><?php echo esc_html( $recent['post_title'] ); ?></a></h6>
                                                    <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date( 'd M Y', $recent['ID'] ); ?></span>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    endforeach;
                                    wp_reset_query();
                                    ?>
                                </ul>
                            </div>

                            <!-- Tags Widget -->
                            <?php
                            $all_tags = get_tags();
                            if ( $all_tags ) : ?>
                                <div class="widget mb-40">
                                    <h3 class="widget-title">Popular Tags</h3>
                                    <div class="widget-tags">
                                        <?php foreach ( $all_tags as $tag ) : ?>
                                            <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </aside>
                    </div>

                </div>
            </div>
        </section>
        <!-- blog-details-area end -->

    <?php endwhile; ?>
</main>

<?php
get_footer();
