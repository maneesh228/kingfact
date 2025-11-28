<?php 
/*
Template Name: Services Page
*/

get_header(); ?>

<!-- breadcrumb-area-start -->
<div class="breadcrumb-area pt-245 pb-255" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/bg/bg-9.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-text text-center">
                    <h1><?php the_title(); ?></h1>
                    <ul class="breadcrumb-menu">
                        <li><a href="<?php echo home_url(); ?>">home</a></li>
                        <li><span><?php the_title(); ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area-end -->

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- Services display using shortcode -->
<?php echo do_shortcode('[services_display show_title="0"]'); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
