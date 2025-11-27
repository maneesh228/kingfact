<?php
/*
Template Name: Contact
Description: Contact page template with form and info
*/
get_header();
?>

<main id="contact-page" class="site-main">

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <p class="page-subtitle">Get in touch with us</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="contact-content">
        <div class="container">
            <div class="row">
                
                <!-- Contact Information -->
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="contact-info-box">
                        <h3>Contact Information</h3>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Address</h4>
                                <p>123 Business Street<br>New York, NY 10001<br>United States</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Phone</h4>
                                <p>+1 (555) 123-4567<br>+1 (555) 987-6543</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Email</h4>
                                <p>info@kingfact.com<br>support@kingfact.com</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Business Hours</h4>
                                <p>Mon - Fri: 9:00 - 19:00<br>Sat: 10:00 - 16:00<br>Sun: Closed</p>
                            </div>
                        </div>

                        <div class="social-links">
                            <h4>Follow Us</h4>
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-8 col-md-12">
                    <div class="contact-form-box">
                        <h3>Send Us a Message</h3>
                        
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php if ( get_the_content() ) : ?>
                                <div class="form-intro">
                                    <?php the_content(); ?>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>

                        <form id="contact-form" class="contact-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
                            <input type="hidden" name="action" value="submit_contact_form">
                            <?php wp_nonce_field( 'contact_form_submit', 'contact_nonce' ); ?>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_name">Your Name *</label>
                                        <input type="text" id="contact_name" name="contact_name" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_email">Your Email *</label>
                                        <input type="email" id="contact_email" name="contact_email" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_phone">Phone Number</label>
                                        <input type="tel" id="contact_phone" name="contact_phone" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_subject">Subject *</label>
                                        <input type="text" id="contact_subject" name="contact_subject" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contact_message">Your Message *</label>
                                <textarea id="contact_message" name="contact_message" class="form-control" rows="6" required></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="b-btn btn-black">
                                    <span>Send Message</span>
                                </button>
                            </div>

                            <div class="form-messages"></div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Map Section (Optional) -->
    <section class="contact-map">
        <div class="container-fluid p-0">
            <!-- You can add Google Maps iframe here -->
            <div class="map-placeholder">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1234567890" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
