<?php

if ( ! function_exists( 'block_based_starter_theme_support' ) ) :
    function block_based_starter_theme_support()  {


		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Alignwide and alignfull classes in the block editor
		add_theme_support( 'align-wide' );


		// Adding support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

	
    }
    add_action( 'after_setup_theme', 'block_based_starter_theme_support' );
endif;




/**
 * Enqueue scripts and styles.
 */
function block_based_starter_theme_scripts() {
	wp_enqueue_style( 'block-based-starter-theme-styles', get_stylesheet_uri() );
	wp_enqueue_style( 'block-based-starter-theme-block-styles', get_template_directory_uri() . '/assets/css/blocks.css' );
}
add_action( 'wp_enqueue_scripts', 'block_based_starter_theme_scripts' );




/**
 * For custom block creation
 */
function add_custom_block() {
	wp_register_script( 'custom-blocks', get_template_directory_uri() . '/build/index.js' ,  
	array('wp-blocks', 'wp-editor','wp-dom-ready', 'wp-element',) );

    register_block_type( 'customized/my-block', array(
        'editor_script' => 'custom-blocks',
    ) 
);
}
add_action( 'init', 'add_custom_block' );