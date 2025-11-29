<?php
/**
 * Template Name: Media Gallery
 * Description: Display images and videos from WordPress Media Library
 */

get_header();

// Get featured image or fallback to default
$breadcrumb_bg = get_the_post_thumbnail_url(get_the_ID(), 'full');
if (!$breadcrumb_bg) {
    $breadcrumb_bg = get_template_directory_uri() . '/assets/img/bg/bdrc-bg.jpg';
}
?>

<!-- breadcrumb-area-start -->
<section class="breadcrumb-area pt-245 pb-255" style="background-image:url(<?php echo esc_url($breadcrumb_bg); ?>)">
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
</section>
<!-- breadcrumb-area-end -->

<!-- media gallery area start -->
<div class="media-gallery-area pt-120 pb-90">
    <div class="container">
        
        <!-- Filter Tabs -->
        <div class="row mb-50">
            <div class="col-xl-12">
                <div class="media-filter text-center">
                    <button class="filter-btn active" data-filter="all">All Media</button>
                    <button class="filter-btn" data-filter="image">Images</button>
                    <button class="filter-btn" data-filter="video">Videos</button>
                </div>
            </div>
        </div>

        <!-- Media Grid -->
        <div class="row media-grid">
            <?php
            // Query media items attached to this page
            $media_args = array(
                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'posts_per_page' => -1,
                'post_mime_type' => array('image', 'video'),
                'post_parent' => get_the_ID(), // Only get media attached to this page
                'orderby' => 'date',
                'order' => 'DESC',
            );
            
            $media_query = new WP_Query($media_args);
            
            if ($media_query->have_posts()) :
                while ($media_query->have_posts()) : $media_query->the_post();
                    
                    $attachment_id = get_the_ID();
                    $mime_type = get_post_mime_type($attachment_id);
                    $is_image = strpos($mime_type, 'image') !== false;
                    $is_video = strpos($mime_type, 'video') !== false;
                    
                    // Determine media type class
                    $media_type_class = '';
                    if ($is_image) {
                        $media_type_class = 'media-item-image';
                    } elseif ($is_video) {
                        $media_type_class = 'media-item-video';
                    }
                    
                    // Get media URL
                    $media_url = wp_get_attachment_url($attachment_id);
                    $media_title = get_the_title();
                    
                    // Get thumbnail for display
                    if ($is_image) {
                        $thumbnail = wp_get_attachment_image_url($attachment_id, 'medium');
                    } else {
                        // For videos, try to get a thumbnail or use a placeholder
                        $thumbnail = wp_get_attachment_image_url($attachment_id, 'medium');
                        if (!$thumbnail) {
                            $thumbnail = get_template_directory_uri() . '/assets/img/bg/video-placeholder.jpg';
                        }
                    }
                    ?>
                    
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30 media-item <?php echo esc_attr($media_type_class); ?>">
                        <div class="media-box">
                            <div class="media-img">
                                <?php if ($is_image) : ?>
                                    <a href="<?php echo esc_url($media_url); ?>" data-lightbox="media-gallery" data-title="<?php echo esc_attr($media_title); ?>">
                                        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($media_title); ?>">
                                        <div class="media-overlay">
                                            <i class="far fa-search-plus"></i>
                                        </div>
                                    </a>
                                <?php elseif ($is_video) : ?>
                                    <div class="video-container">
                                        <video controls preload="metadata">
                                            <source src="<?php echo esc_url($media_url); ?>" type="<?php echo esc_attr($mime_type); ?>">
                                            Your browser does not support the video tag.
                                        </video>
                                        <div class="video-play-overlay">
                                            <i class="far fa-play-circle"></i>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if ($media_title) : ?>
                                <div class="media-caption">
                                    <h4><?php echo esc_html($media_title); ?></h4>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <div class="col-xl-12">
                    <div class="no-media-found text-center">
                        <p>No media files found. Please upload images or videos from the WordPress Media Library.</p>
                        <?php if (current_user_can('upload_files')) : ?>
                            <a href="<?php echo admin_url('upload.php'); ?>" class="b-btn btn-black mt-20"><span>Go to Media Library</span></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
    </div>
</div>
<!-- media gallery area end -->

<style>
/* Media Gallery Styles */
.media-filter {
    margin-bottom: 30px;
}

.filter-btn {
    background: #f5f5f5;
    border: none;
    padding: 12px 30px;
    margin: 0 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    text-transform: uppercase;
    transition: all 0.3s;
}

.filter-btn:hover,
.filter-btn.active {
    background: #ff6b35;
    color: #fff;
}

.media-box {
    position: relative;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 0 20px rgba(0,0,0,0.08);
    transition: all 0.3s;
}

.media-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.media-img {
    position: relative;
    overflow: hidden;
    height: 300px;
}

.media-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.media-box:hover .media-img img {
    transform: scale(1.1);
}

/* Video Container Styles */
.video-container {
    position: relative;
    width: 100%;
    height: 100%;
}

.video-container video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.video-play-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    pointer-events: none;
    transition: opacity 0.3s;
}

.video-container:hover .video-play-overlay {
    opacity: 0;
}

.video-play-overlay i {
    font-size: 60px;
    color: #fff;
    text-shadow: 0 2px 10px rgba(0,0,0,0.5);
}

.media-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 107, 53, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.media-box:hover .media-overlay {
    opacity: 1;
}

.media-overlay i {
    font-size: 48px;
    color: #fff;
}

.media-caption {
    padding: 20px;
    text-align: center;
}

.media-caption h4 {
    font-size: 18px;
    margin: 0;
    color: #333;
}

.media-item {
    transition: all 0.3s;
}

.media-item.hide {
    display: none;
}

.no-media-found {
    padding: 60px 20px;
}

.no-media-found p {
    font-size: 18px;
    color: #666;
}
</style>

<script>
jQuery(document).ready(function($) {
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const mediaItems = document.querySelectorAll('.media-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            mediaItems.forEach(item => {
                if (filter === 'all') {
                    item.classList.remove('hide');
                } else if (filter === 'image' && item.classList.contains('media-item-image')) {
                    item.classList.remove('hide');
                } else if (filter === 'video' && item.classList.contains('media-item-video')) {
                    item.classList.remove('hide');
                } else {
                    item.classList.add('hide');
                }
            });
            
            // Re-initialize lightbox after filter
            initializeLightbox();
        });
    });
    
    // Initialize lightbox
    function initializeLightbox() {
        // Image lightbox
        $('[data-lightbox="media-gallery"]').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            },
            image: {
                titleSrc: 'data-title'
            }
        });
        
        // Video popup
        $('.video-popup').magnificPopup({
            type: 'iframe',
            iframe: {
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: 'v=',
                        src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                    },
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: 'https://player.vimeo.com/video/%id%?autoplay=1'
                    }
                }
            }
        });
    }
    
    // Initial lightbox setup
    initializeLightbox();
});
</script>

<?php
get_footer();
