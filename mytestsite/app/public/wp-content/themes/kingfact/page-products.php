<?php 
/*
Template Name: Products Page
*/

get_header();

// Get featured image or fallback to default
$breadcrumb_bg = get_the_post_thumbnail_url(get_the_ID(), 'full');
if (!$breadcrumb_bg) {
    $breadcrumb_bg = get_template_directory_uri() . '/assets/img/bg/bg-9.jpg';
}
?>

<!-- breadcrumb-area-start -->
<div class="breadcrumb-area pt-245 pb-255" style="background-image:url(<?php echo esc_url($breadcrumb_bg); ?>)">
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

<!-- Products display using shortcode -->
<?php echo do_shortcode('[products_display show_title="0"]'); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
