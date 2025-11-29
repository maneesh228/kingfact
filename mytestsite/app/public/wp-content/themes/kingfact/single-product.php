<?php get_header(); ?>

<?php echo do_shortcode('[kingfact_breadcrumb title="' . get_the_title() . '" current="Products" home_label="Home" home_url="' . home_url('/') . '"]'); ?>

<!-- Product detail area -->
<section class="product-detail-area pt-120 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="product-detail-wrapper">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                    <div class="product-detail-content">
                        <h2><?php the_title(); ?></h2>
                        
                        <?php
                        $product_price = get_post_meta(get_the_ID(), '_product_price', true);
                        if (!empty($product_price)) :
                        ?>
                        <div class="product-price mb-20">
                            <span class="price"><?php echo esc_html($product_price); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="product-image mb-30">
                            <?php the_post_thumbnail('large', array('alt' => get_the_title(), 'class' => 'img-fluid')); ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="product-description">
                            <?php the_content(); ?>
                        </div>
                        
                        <?php
                        // Product Images Gallery
                        $product_images = get_post_meta(get_the_ID(), '_product_images', true);
                        if (!empty($product_images)) :
                        ?>
                        <div class="product-images-section mt-40 mb-40">
                            <h3>Product Images</h3>
                            <div class="product-gallery">
                                <div class="row">
                                    <?php 
                                    $images = explode(',', $product_images);
                                    foreach ($images as $image_id) : 
                                        $image_id = trim($image_id);
                                        if (!empty($image_id)) :
                                            $image_url = wp_get_attachment_image_url($image_id, 'medium');
                                            $image_full = wp_get_attachment_image_url($image_id, 'large');
                                            if ($image_url) :
                                    ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6 mb-20">
                                        <div class="gallery-item">
                                            <a href="<?php echo esc_url($image_full); ?>" class="gallery-link" data-lightbox="product-gallery">
                                                <img src="<?php echo esc_url($image_url); ?>" alt="Product Image" class="img-fluid">
                                                <div class="gallery-overlay">
                                                    <i class="fas fa-expand-arrows-alt"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php 
                                            endif;
                                        endif;
                                    endforeach; 
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php
                        // Product Videos
                        $product_videos = get_post_meta(get_the_ID(), '_product_videos', true);
                        if (!empty($product_videos)) :
                        ?>
                        <div class="product-videos-section mt-40 mb-40">
                            <h3>Product Videos</h3>
                            <div class="product-videos">
                                <div class="row">
                                    <?php 
                                    // Handle different line break formats (Windows \r\n, Unix \n, Mac \r)
                                    $product_videos = str_replace(array("\r\n", "\r"), "\n", $product_videos);
                                    
                                    // Split by newlines first
                                    $video_lines = explode("\n", $product_videos);
                                    $videos = array();
                                    
                                    // For each line, also check if there are multiple URLs separated by spaces
                                    foreach ($video_lines as $line) {
                                        $line = trim($line);
                                        if (!empty($line)) {
                                            // Check if line contains multiple URLs (space-separated)
                                            if (preg_match_all('/https?:\/\/[^\s]+/', $line, $matches)) {
                                                foreach ($matches[0] as $url) {
                                                    $videos[] = $url;
                                                }
                                            } else {
                                                $videos[] = $line;
                                            }
                                        }
                                    }
                                    
                                    $video_count = 0;
                                    foreach ($videos as $video_url) : 
                                        $video_url = trim($video_url);
                                        if (!empty($video_url)) :
                                            $video_count++;
                                            
                                            // Check if it's a YouTube URL
                                            if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) :
                                                // Extract video ID
                                                preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $video_url, $matches);
                                                $video_id = isset($matches[1]) ? $matches[1] : '';
                                                if ($video_id) :
                                    ?>
                                    <div class="col-lg-6 col-md-12 mb-20">
                                        <div class="video-item">
                                            <div class="video-wrapper">
                                                <iframe 
                                                    src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>" 
                                                    frameborder="0" 
                                                    allowfullscreen
                                                    class="video-iframe">
                                                </iframe>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                                endif;
                                            else :
                                                // For other video URLs (Vimeo, direct video files, etc.)
                                    ?>
                                    <div class="col-lg-6 col-md-12 mb-20">
                                        <div class="video-item">
                                            <div class="video-wrapper">
                                                <video controls class="video-player">
                                                    <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                            endif;
                                        endif;
                                    endforeach; 
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php
                        $product_url = get_post_meta(get_the_ID(), '_product_url', true);
                        $product_link_text = get_post_meta(get_the_ID(), '_product_link_text', true);
                        
                        if (empty($product_link_text)) {
                            $product_link_text = 'Learn More';
                        }
                        
                        if (!empty($product_url)) :
                        ?>
                        <div class="product-cta mt-30">
                            <a href="<?php echo esc_url($product_url); ?>" class="btn btn-primary" target="_blank">
                                <?php echo esc_html($product_link_text); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php endwhile; endif; ?>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-12">
                <aside class="product-sidebar">
                    
                    <!-- Related Products -->
                    <div class="widget mb-40">
                        <div class="widget-title-box mb-30">
                            <!-- <span class="animate-border"></span> -->
                            <h3 class="widget-title">Related Products</h3>
                        </div>
                        <div class="recent-products">
                            <?php
                            $current_id = get_the_ID();
                            $related_products = new WP_Query(array(
                                'post_type' => 'product',
                                'posts_per_page' => 3,
                                'post__not_in' => array($current_id),
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'post_status' => 'publish'
                            ));
                            
                            if ($related_products->have_posts()) :
                                while ($related_products->have_posts()) : $related_products->the_post();
                                    $related_price = get_post_meta(get_the_ID(), '_product_price', true);
                            ?>
                            
                            <div class="recent-product-item mb-20">
                                <div class="row">
                                    <?php if (has_post_thumbnail()) : ?>
                                    <div class="col-4">
                                        <div class="recent-product-thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('thumbnail', array('alt' => get_the_title())); ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                    <?php else : ?>
                                    <div class="col-12">
                                    <?php endif; ?>
                                        <div class="recent-product-content">
                                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <?php if (!empty($related_price)) : ?>
                                            <div class="recent-product-price">
                                                <span><?php echo esc_html($related_price); ?></span>
                                            </div>
                                            <?php endif; ?>
                                            <p><?php echo wp_trim_words(get_the_excerpt(), 8, '...'); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php 
                                endwhile;
                                wp_reset_postdata();
                            else :
                            ?>
                            <p>No related products found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Contact Widget -->
                    <div class="widget mb-40">
                        <div class="widget-title-box mb-30">
                            <!-- <span class="animate-border"></span> -->
                            <h3 class="widget-title">Need Help?</h3>
                        </div>
                        <div class="contact-widget">
                            <div class="contact-widget-content">
                                <p>Have questions about this product? Get in touch with our team for more information.</p>
                                
                                <div class="contact-info mt-20">
                                    <div class="contact-item mb-10">
                                        <i class="fas fa-phone"></i>
                                        <span>+1 (555) 123-4567</span>
                                    </div>
                                    <div class="contact-item mb-10">
                                        <i class="fas fa-envelope"></i>
                                        <span>info@yoursite.com</span>
                                    </div>
                                </div>
                                
                                <div class="contact-btn mt-20">
                                    <a href="/contact" class="btn btn-outline-primary btn-sm">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- All Products Link -->
                    <div class="widget mb-40">
                        <div class="all-products-widget">
                            <div class="widget-content text-center">
                                <h4>Explore All Products</h4>
                                <p>Discover our complete range of products and solutions.</p>
                                <a href="/products" class="btn btn-primary">View All Products</a>
                            </div>
                        </div>
                    </div>
                    
                </aside>
            </div>
            
        </div>
    </div>
</section>
<!-- Product detail area end -->

<style>
.product-detail-content h2 {
    color: #333;
    margin-bottom: 15px;
}

.product-price .price {
    font-size: 24px;
    font-weight: bold;
    color: #e74c3c;
}

.product-image {
    text-align: center;
}

.product-image img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.product-description {
    font-size: 16px;
    line-height: 1.6;
    color: #666;
}

/* Product Images Gallery Styles */
.product-images-section h3,
.product-videos-section h3 {
    color: #333;
    margin-bottom: 20px;
    font-size: 20px;
    font-weight: bold;
    border-bottom: 2px solid #007cba;
    padding-bottom: 10px;
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.gallery-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 124, 186, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-overlay i {
    color: white;
    font-size: 24px;
}

/* Product Videos Styles */
.video-item {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.video-wrapper {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
}

.video-iframe,
.video-player {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 8px;
}

.video-player {
    position: relative;
    padding-bottom: 0;
}

.product-cta .btn {
    padding: 12px 30px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.recent-product-item {
    padding: 15px;
    border: 1px solid #eee;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.recent-product-item:hover {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.recent-product-content h4 {
    font-size: 14px;
    margin-bottom: 5px;
}

.recent-product-content h4 a {
    color: #333;
    text-decoration: none;
}

.recent-product-content h4 a:hover {
    color: #007cba;
}

.recent-product-price span {
    font-weight: bold;
    color: #e74c3c;
    font-size: 12px;
}

.recent-product-thumb img {
    width: 100%;
    height: 60px;
    object-fit: cover;
    border-radius: 4px;
}

.contact-widget {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 5px;
}

.contact-item {
    display: flex;
    align-items: center;
}

.contact-item i {
    margin-right: 10px;
    color: #007cba;
    width: 16px;
}

.all-products-widget {
    background: linear-gradient(135deg, #007cba, #0056b3);
    padding: 30px 20px;
    border-radius: 10px;
    text-align: center;
}

.all-products-widget h4 {
    color: white;
    margin-bottom: 10px;
}

.all-products-widget p {
    color: rgba(255,255,255,0.9);
    margin-bottom: 20px;
}

.all-products-widget .btn {
    background: white;
    color: #007cba;
    border: none;
    padding: 10px 25px;
    font-weight: bold;
}

.all-products-widget .btn:hover {
    background: #f8f9fa;
    transform: translateY(-2px);
}

.widget-title-box {
    position: relative;
}

.animate-border {
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 50px;
    height: 3px;
    background: #007cba;
}

/* Simple Lightbox Styles */
.lightbox-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
    z-index: 9999;
    cursor: pointer;
}

.lightbox-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 90%;
    max-height: 90%;
}

.lightbox-content img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.lightbox-close {
    position: absolute;
    top: 20px;
    right: 30px;
    color: white;
    font-size: 30px;
    font-weight: bold;
    cursor: pointer;
    z-index: 10000;
}

.lightbox-close:hover {
    color: #ccc;
}
</style>

<!-- Simple Lightbox HTML -->
<div id="lightbox" class="lightbox-overlay">
    <span class="lightbox-close">&times;</span>
    <div class="lightbox-content">
        <img src="" alt="Product Image">
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Simple lightbox functionality
    $('.gallery-link').on('click', function(e) {
        e.preventDefault();
        var imageSrc = $(this).attr('href');
        $('#lightbox img').attr('src', imageSrc);
        $('#lightbox').fadeIn(300);
    });
    
    // Close lightbox
    $('#lightbox, .lightbox-close').on('click', function() {
        $('#lightbox').fadeOut(300);
    });
    
    // Prevent closing when clicking on image
    $('.lightbox-content img').on('click', function(e) {
        e.stopPropagation();
    });
    
    // Close with ESC key
    $(document).on('keyup', function(e) {
        if (e.keyCode === 27) {
            $('#lightbox').fadeOut(300);
        }
    });
});
</script>

<?php get_footer(); ?>
