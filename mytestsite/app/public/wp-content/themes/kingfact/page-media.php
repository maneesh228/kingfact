<?php
/**
 * Template Name: Media Gallery
 * Description: Display images and videos from WordPress Media Library
 */

get_header();

// Get ACF banner image or fallback to featured image or default
$banner_image = get_field('media_banner_image');
if (!$banner_image) {
    $banner_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
}
if (!$banner_image) {
    $banner_image = get_template_directory_uri() . '/assets/img/bg/bdrc-bg.jpg';
}

// Get ACF breadcrumb text or use defaults
$banner_title = get_field('media_banner_title') ?: 'Media';
$breadcrumb_home = get_field('media_breadcrumb_home') ?: 'home';
$breadcrumb_current = get_field('media_breadcrumb_current') ?: 'media';
?>

<!-- breadcrumb-area-start -->
<section class="breadcrumb-area pt-245 pb-255" style="background-image:url(<?php echo esc_url($banner_image); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-text text-center">
                    <h1><?php echo esc_html($banner_title); ?></h1>
                    <ul class="breadcrumb-menu">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($breadcrumb_home); ?></a></li>
                        <li><span><?php echo esc_html($breadcrumb_current); ?></span></li>
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

        <!-- Instructions Section (if available) -->
        <?php 
        $instructions = get_field('media_instructions');
        if ($instructions) : ?>
            <div class="row mb-40">
                <div class="col-xl-12">
                    <div class="media-instructions">
                        <?php echo wp_kses_post($instructions); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Media Grid -->
        <div class="row media-grid">
            <?php
            // Get custom media galleries
            $image_gallery = get_post_meta(get_the_ID(), '_media_image_gallery', true);
            $video_gallery = get_post_meta(get_the_ID(), '_media_video_gallery', true);
            
            $has_media = false;
            
            // Display Images
            if (!empty($image_gallery) && is_array($image_gallery)) :
                foreach ($image_gallery as $image_id) :
                    if (!$image_id) continue;
                    $has_media = true;
                    
                    $image_url = wp_get_attachment_image_url($image_id, 'full');
                    $thumbnail = wp_get_attachment_image_url($image_id, 'medium_large');
                    $image_title = get_the_title($image_id);
                    $image_caption = wp_get_attachment_caption($image_id);
                    
                    if (!$image_url) continue;
                    ?>
                    
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30 media-item media-item-image">
                        <div class="media-box">
                            <div class="media-img">
                                <a href="<?php echo esc_url($image_url); ?>" data-lightbox="media-gallery" data-title="<?php echo esc_attr($image_title ? $image_title : $image_caption); ?>">
                                    <img src="<?php echo esc_url($thumbnail ? $thumbnail : $image_url); ?>" alt="<?php echo esc_attr($image_title ? $image_title : $image_caption); ?>">
                                    <div class="media-overlay">
                                        <i class="far fa-search-plus"></i>
                                    </div>
                                </a>
                            </div>
                            <?php if ($image_title || $image_caption) : ?>
                                <div class="media-caption">
                                    <h4><?php echo esc_html($image_title ? $image_title : $image_caption); ?></h4>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                <?php
                endforeach;
            endif;
            
            // Display Videos
            if (!empty($video_gallery) && is_array($video_gallery)) :
                foreach ($video_gallery as $video_url) :
                    if (!$video_url) continue;
                    $has_media = true;
                    
                    // Detect video type (YouTube, Vimeo, or direct)
                    $is_youtube = (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false);
                    $is_vimeo = (strpos($video_url, 'vimeo.com') !== false);
                    
                    // Get video thumbnail
                    $video_thumbnail = '';
                    if ($is_youtube) {
                        // Extract YouTube ID
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $video_url, $matches);
                        if (isset($matches[1])) {
                            $youtube_id = $matches[1];
                            $video_thumbnail = 'https://img.youtube.com/vi/' . $youtube_id . '/maxresdefault.jpg';
                        }
                    } elseif ($is_vimeo) {
                        // For Vimeo, we'll use a placeholder or you can implement Vimeo API
                        $video_thumbnail = get_template_directory_uri() . '/assets/img/bg/video-placeholder.jpg';
                    }
                    
                    if (!$video_thumbnail) {
                        $video_thumbnail = get_template_directory_uri() . '/assets/img/bg/video-placeholder.jpg';
                    }
                    ?>
                    
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30 media-item media-item-video">
                        <div class="media-box">
                            <div class="media-img">
                                <?php if ($is_youtube || $is_vimeo) : ?>
                                    <a href="<?php echo esc_url($video_url); ?>" class="video-popup">
                                        <img src="<?php echo esc_url($video_thumbnail); ?>" alt="Video">
                                        <div class="media-overlay">
                                            <i class="far fa-play-circle"></i>
                                        </div>
                                    </a>
                                <?php else : ?>
                                    <div class="video-container">
                                        <video controls preload="metadata">
                                            <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <div class="video-play-overlay">
                                            <i class="far fa-play-circle"></i>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                <?php
                endforeach;
            endif;
            
            // Show message if no media
            if (!$has_media) :
                ?>
                <div class="col-xl-12">
                    <div class="no-media-found text-center">
                        <p>No media files found. Please add images or videos from the Media Galleries section in the page editor.</p>
                        <?php if (current_user_can('edit_pages')) : ?>
                            <a href="<?php echo get_edit_post_link(); ?>" class="b-btn btn-black mt-20"><span>Edit Page</span></a>
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
.media-instructions {
    background: #f8f8f8;
    padding: 30px;
    border-radius: 5px;
    margin-bottom: 30px;
    border-left: 4px solid #febc35;
}

.media-instructions p {
    margin: 0 0 15px;
    line-height: 1.8;
}

.media-instructions p:last-child {
    margin-bottom: 0;
}

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
    background: #febc35;
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
    background: #febc35;
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
