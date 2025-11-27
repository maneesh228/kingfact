<?php
/**
 * Default Page Template
 * This is used for any page that doesn't have a specific template assigned
 */
get_header();
?>

<main class="site-main">
    
    <?php while ( have_posts() ) : the_post(); ?>
        
        <!-- Page Header -->
        <section class="page-header">
            <div class="container">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>
        </section>

        <!-- Page Content -->
        <section class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="page-featured-image">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="page-content-text">
                                <?php the_content(); ?>
                            </div>

                            <?php
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                            ?>

                        </article>
                    </div>
                </div>
            </div>
        </section>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
