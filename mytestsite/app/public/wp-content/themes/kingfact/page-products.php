<?php 
/*
Template Name: Products Page
*/

get_header(); ?>

<!-- breadcrumb-area -->
<section class="breadcrumb-area d-flex  p-relative align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2><?php the_title(); ?></h2>   
                        <?php echo do_shortcode('[kingfact_breadcrumb]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb-area-end -->

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- Products display using shortcode -->
<?php echo do_shortcode('[products_display show_title="0"]'); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
