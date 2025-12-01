<?php
/**
 * Contact Form 7 Setup
 * Creates a default contact form on theme activation
 */

// Create default Contact Form 7 form
function kingfact_create_default_contact_form() {
    // Check if Contact Form 7 is active
    if ( ! class_exists( 'WPCF7_ContactForm' ) ) {
        return;
    }

    // Check if form already exists
    $existing_forms = get_posts( array(
        'post_type'   => 'wpcf7_contact_form',
        'post_status' => 'publish',
        'numberposts' => 1,
    ) );

    if ( ! empty( $existing_forms ) ) {
        return; // Form already exists
    }

    // Form template matching your theme design
    $form_template = '<div class="row">
    <div class="col-md-4">
        <div class="contacts-icon contactss-name">
            [text* your-name placeholder "Your Name...."]
        </div>
    </div>
    <div class="col-md-4">
        <div class="contacts-icon contactss-email">
            [email* your-email placeholder "Your Email...."]
        </div>
    </div>
    <div class="col-md-4">
        <div class="contacts-icon contactss-website">
            [url your-website placeholder "Your Website...."]
        </div>
    </div>
    <div class="col-md-12">
        <div class="contacts-icon contactss-message">
            [textarea* your-message placeholder "Your Comments...."]
        </div>
    </div>
    <div class="col-md-12">
        <div class="contacts-us-form-button text-center">
            [submit "Send Message"]
        </div>
    </div>
</div>';

    // Email template
    $mail_template = array(
        'subject'               => 'Contact Form: "[your-subject]"',
        'sender'                => '[your-name] <wordpress@' . $_SERVER['SERVER_NAME'] . '>',
        'body'                  => 'From: [your-name] <[your-email]>' . "\n" .
                                   'Website: [your-website]' . "\n\n" .
                                   'Message:' . "\n" .
                                   '[your-message]',
        'recipient'             => get_option( 'admin_email' ),
        'additional_headers'    => 'Reply-To: [your-email]',
        'attachments'           => '',
        'use_html'              => 0,
        'exclude_blank'         => 0,
    );

    // Auto-reply email template
    $mail2_template = array(
        'active'                => true,
        'subject'               => 'Thank you for contacting us',
        'sender'                => get_bloginfo( 'name' ) . ' <wordpress@' . $_SERVER['SERVER_NAME'] . '>',
        'body'                  => 'Dear [your-name],' . "\n\n" .
                                   'Thank you for your message. We have received your inquiry and will get back to you as soon as possible.' . "\n\n" .
                                   'Best regards,' . "\n" .
                                   get_bloginfo( 'name' ),
        'recipient'             => '[your-email]',
        'additional_headers'    => '',
        'attachments'           => '',
        'use_html'              => 0,
        'exclude_blank'         => 0,
    );

    // Messages
    $messages = array(
        'mail_sent_ok'          => "Thank you for your message. It has been sent.",
        'mail_sent_ng'          => "There was an error trying to send your message. Please try again later.",
        'validation_error'      => "One or more fields have an error. Please check and try again.",
        'spam'                  => "There was an error trying to send your message. Please try again later.",
        'accept_terms'          => "You must accept the terms and conditions before sending your message.",
        'invalid_required'      => "The field is required.",
        'invalid_too_long'      => "The field is too long.",
        'invalid_too_short'     => "The field is too short.",
        'upload_failed'         => "There was an unknown error uploading the file.",
        'upload_file_type_invalid' => "You are not allowed to upload files of this type.",
        'upload_file_too_large' => "The file is too big.",
        'upload_failed_php_error' => "There was an error uploading the file.",
    );

    // Create the contact form
    $contact_form = WPCF7_ContactForm::get_template();
    $properties = $contact_form->get_properties();

    $properties['form'] = $form_template;
    $properties['mail'] = $mail_template;
    $properties['mail_2'] = $mail2_template;
    $properties['messages'] = $messages;

    $contact_form->set_properties( $properties );
    $contact_form->set_title( 'Contact Form - Kingfact Theme' );
    $contact_form->save();

    // Store the form ID for reference
    update_option( 'kingfact_contact_form_id', $contact_form->id() );
}

// Run on theme activation (you can also run manually)
add_action( 'after_setup_theme', 'kingfact_create_default_contact_form' );

// Helper function to get the contact form shortcode
function kingfact_get_contact_form_shortcode() {
    $form_id = get_option( 'kingfact_contact_form_id' );
    
    if ( $form_id ) {
        return '[contact-form-7 id="' . $form_id . '"]';
    }
    
    // Fallback: Get the first available form
    $forms = get_posts( array(
        'post_type'   => 'wpcf7_contact_form',
        'post_status' => 'publish',
        'numberposts' => 1,
    ) );
    
    if ( ! empty( $forms ) ) {
        return '[contact-form-7 id="' . $forms[0]->ID . '"]';
    }
    
    return '[contact-form-7 id="1"]'; // Default fallback
}
