<?php
/*
Template for 404 - Page Not Found
*/
get_header();
?>

<style>
.error-404-area {
    min-height: 70vh;
    display: flex;
    align-items: center;
}
.error-404-content {
    text-align: center;
}
.error-404-content h1 {
    font-size: 120px;
    font-weight: bold;
    color: #f1c40f;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}
.error-404-content h2 {
    font-size: 36px;
    margin-bottom: 20px;
    color: #333;
}
.error-404-content p {
    font-size: 18px;
    color: #666;
    margin-bottom: 30px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}
.error-404-buttons {
    margin-top: 40px;
}
.error-404-buttons .btn {
    margin: 0 10px 10px 10px;
}
.search-box {
    max-width: 500px;
    margin: 40px auto;
}
.search-box input[type="text"] {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #ddd;
    border-radius: 50px;
    font-size: 16px;
    margin-bottom: 20px;
}
.search-box button {
    background: #333;
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 50px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}
.search-box button:hover {
    background: #555;
}
.helpful-links {
    margin-top: 50px;
}
.helpful-links h3 {
    margin-bottom: 20px;
    color: #333;
}
.helpful-links ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.helpful-links li {
    margin-bottom: 10px;
}
.helpful-links a {
    color: #007cba;
    text-decoration: none;
    font-size: 16px;
    transition: color 0.3s;
}
.helpful-links a:hover {
    color: #333;
}
</style>

<!-- Breadcrumb Area -->
<?php echo do_shortcode('[kingfact_breadcrumb title="Page Not Found" current="404 Error"]'); ?>

<div class="error-404-area pt-130 pb-130">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="error-404-content">
                    <h1>404</h1>
                    <h2>Oops! Page Not Found</h2>
                    <p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Don't worry, it happens to the best of us!</p>
                    
                    <!-- Search Box -->
                    <div class="search-box">
                        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <input type="text" 
                                   name="s" 
                                   placeholder="Search for what you're looking for..." 
                                   value="<?php echo get_search_query(); ?>" 
                                   required>
                            <button type="submit">Search</button>
                        </form>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="error-404-buttons">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="b-btn btn-black">
                            <span>Go to Homepage</span>
                        </a>
                        <a href="javascript:history.back()" class="b-btn btn-outline">
                            <span>Go Back</span>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="b-btn btn-outline">
                            <span>Contact Us</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Helpful Links Section -->
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="helpful-links text-center">
                    <h3>Popular Pages</h3>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About Us</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Our Services</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="helpful-links text-center">
                    <h3>Recent Services</h3>
                    <ul>
                        <?php
                        $recent_services = get_posts( array(
                            'post_type' => 'service',
                            'numberposts' => 4,
                            'post_status' => 'publish',
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ) );
                        
                        if ( $recent_services ) {
                            foreach ( $recent_services as $service ) {
                                echo '<li><a href="' . esc_url( get_permalink( $service->ID ) ) . '">' . esc_html( $service->post_title ) . '</a></li>';
                            }
                        } else {
                            echo '<li>No services found</li>';
                        }
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-12">
                <div class="helpful-links text-center">
                    <h3>Need Help?</h3>
                    <p>If you believe this is an error, please contact us and we'll help you find what you're looking for.</p>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="b-btn btn-black">
                        <span>Get Help</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-focus on search input
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search-box input[type="text"]');
    if (searchInput) {
        searchInput.focus();
    }
});

// Add some interaction for the back button
document.addEventListener('DOMContentLoaded', function() {
    const backButton = document.querySelector('a[href="javascript:history.back()"]');
    if (backButton) {
        backButton.addEventListener('click', function(e) {
            e.preventDefault();
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '<?php echo esc_url( home_url( '/' ) ); ?>';
            }
        });
    }
});
</script>

<?php get_footer(); ?>
