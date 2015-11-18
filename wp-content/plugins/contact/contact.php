<?php
/*
Plugin Name: Footer Contact & Prayer Request Form
Plugin URI: none
Description: Simple non-bloated WordPress Contact Form
Version: 1.0
Author: Agbonghama Collins, adapted by Krissie VandeNoord
Author URI: http://w3guy.com, http://honeystreet.com
*/
 
function html_form_code() {
    echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
    echo '<p>';
    echo '<input type="text" name="cf-name" placeholder="NAME" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) . '" />';
    echo '</p>';
    echo '<p>';
    echo '<input type="email" name="cf-email" placeholder="EMAIL" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" />';
    echo '<input type="url" class="honey" name="cf-url" placeholder="URL" value="' . ( isset( $_POST["cf-url"] ) ? esc_attr( $_POST["cf-url"] ) : '' ) . '" />';
    echo '</p>';
    echo '<p>';
    echo '<textarea rows="3" placeholder="MESSAGE OR REQUEST" name="cf-message">' . ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ) . '</textarea>';
    echo '</p>';
    echo '<div class="QapTcha"></div>';
    echo '<p class="hidden"><input type="submit" name="cf-submitted" value="Send"></p>';
   
    echo '</form>';
}
 
function deliver_mail() {
 
    // if the submit button is clicked, send the email
    if ( isset( $_POST['cf-submitted'] ) && $_POST["cf-url"]=='' ) {
 
        // sanitize form values
        $name    = sanitize_text_field( $_POST["cf-name"] );
        $email   = sanitize_email( $_POST["cf-email"] );
        $subject = 'Website Contact and Prayer Request Form Submission';
        $message = esc_textarea( $_POST["cf-message"] );
 
        // get the blog administrator's email address
        $to = get_field( 'main_campus_email','options' );
        //$to = 'krissie@honeystreet.com';
 
        $headers = "From: $name <$email>" . "\r\n";
 
        // If email has been process for sending, display a success message
        if ( wp_mail( $to, $subject, $message, $headers ) ) {
            echo '<div>';
            echo '<p class="success">Thanks for getting in touch with us. Your request has been submitted.</p>';
            echo '</div>';
        } else {
            echo '<div>';
            echo '<p class="error">We\'re terribly sorry, but it looks like an error occurred. Please make sure all fields are filled out and try submitting your request again.</p>';
            echo '</div>';
        }
    }
}
 
function cf_shortcode() {
    ob_start();
    deliver_mail();
    html_form_code();
 
    return ob_get_clean();
}
 
add_shortcode( 'sitepoint_contact_form', 'cf_shortcode' );
 
?>