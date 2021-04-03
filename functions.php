<?php

if ( ! function_exists( 'block_based_starter_theme_support' ) ) :
    function block_based_starter_theme_support()  {

		// Make theme available for translation.
		load_theme_textdomain( 'block-based-starter-theme', get_template_directory() . '/languages' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Alignwide and alignfull classes in the block editor
		add_theme_support( 'align-wide' );

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Adding support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Support a custom color palette.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Strong Blue', 'block-based-starter-theme' ),
				'slug'  => 'strong-blue',
				'color' => '#0073aa',
			),
			array(
				'name'  => __( 'Lighter Blue', 'block-based-starter-theme' ),
				'slug'  => 'lighter-blue',
				'color' => '#229fd8',
			),
			array(
				'name'  => __( 'Very Light Gray', 'block-based-starter-theme' ),
				'slug'  => 'very-light-gray',
				'color' => '#eee',
			),
			array(
				'name'  => __( 'Very Dark Gray', 'block-based-starter-theme' ),
				'slug'  => 'very-dark-gray',
				'color' => '#444',
			),
		) );

		// Starter content
		add_theme_support('starter-content', [
			// Static front page set to Home, posts page set to Blog
			'options' => [
				'show_on_front' => 'page',
				'page_on_front' => '{{home}}',
			],
			// Starter pages to include
			'posts' => [
				'home',
				'blog' => [
					'post_title' => _x( 'Blog', 'block-based-starter-theme' ),
					'post_content' => '<!-- wp:template-part {"slug":"blog","theme":"block-based-starter-theme"} -->'
				],
			]
		]);
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