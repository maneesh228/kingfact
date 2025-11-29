<?php
/**
 * Template Name: Terms of Use
 * Description: Template for Terms of Use page
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

<!-- Terms of Use Content Area Start -->
<div class="terms-area pd-top-120 pd-bottom-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="terms-content">
                    <?php
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Terms of Use Content Area End -->

<?php get_footer(); ?>
