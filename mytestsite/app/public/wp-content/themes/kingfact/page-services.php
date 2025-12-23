<?php 
/*
Template Name: Services Page
*/

get_header();

// Get banner image - priority: ACF custom image > Default (skip featured image)
$breadcrumb_bg = get_field('services_page_banner_image');
if (!$breadcrumb_bg) {
    $breadcrumb_bg = get_template_directory_uri() . '/assets/img/bg/bg-9.jpg';
}

// Get banner title - use ACF field or fallback to page title
$banner_title = get_field('services_page_banner_title');
if (empty($banner_title)) {
    $banner_title = get_the_title();
}

// Get breadcrumb texts
$breadcrumb_home = get_field('services_page_breadcrumb_home') ?: 'home';
$breadcrumb_current = get_field('services_page_breadcrumb_current');
if (empty($breadcrumb_current)) {
    $breadcrumb_current = get_the_title();
}
?>

<!-- breadcrumb-area-start -->
<div class="breadcrumb-area" style="background-image:url(<?php echo esc_url($breadcrumb_bg); ?>); min-height: 350px; display: flex; align-items: center;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-text text-center">
                    <h1><?php echo esc_html($banner_title); ?></h1>
                    <ul class="breadcrumb-menu">
                        <li><a href="<?php echo home_url(); ?>"><?php echo esc_html($breadcrumb_home); ?></a></li>
                        <li><span><?php echo esc_html($breadcrumb_current); ?></span></li>
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
