<?php
function spacious_dj_enqueue_styles() {

    $parent_style = 'spacious_style'; // Style id of the parent theme

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

// Remove 'google_fonts' from the styles queue (id may vary for other themes)
function spacious_dj_dequeue_google_fonts() {
	wp_dequeue_style( 'google_fonts' );
}
// Use 100 for priority to process the remove action at the end of the queue
add_action( 'wp_enqueue_scripts', 'spacious_dj_dequeue_google_fonts', 100 );
add_action( 'wp_enqueue_scripts', 'spacious_dj_enqueue_styles' );
?>
