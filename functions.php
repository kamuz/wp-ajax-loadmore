<?php
/**
 * Add menu support
 *
 * @package Simple_Theme
 */

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'menus' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
}

/**
 * Add Gutenberg support
 */
function simple_theme_setup() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor.css' );
}
add_action( 'after_setup_theme', 'simple_theme_setup' );

/**
 * Register Scripts and Style
 */
function theme_register_scripts() {
	wp_enqueue_style( 'simple-css', get_stylesheet_uri(), false, '1.0.0' );
	wp_enqueue_script( 'simple-js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0', true );
	wp_register_script( 'kamuz-ajax', get_stylesheet_directory_uri() . '/assets/js/ajax.js', array( 'jquery' ), time(), true );
	wp_localize_script( 'kamuz-ajax', 'kamuz', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_script( 'kamuz-ajax' );
}
add_action( 'wp_enqueue_scripts', 'theme_register_scripts', 1 );

/**
 * Debug function
 *
 * @param mixed $arr Data to debug.
 */
function dd( $arr ) {
	echo '<pre>';
	print_r( $arr );
	echo '</pre>';
}

/**
 * Load more AJAX handler
 */
function kamuz_loadmore_pagination() {
	$paged = ! empty( $_POST['paged'] ) ? $_POST['paged'] : 1;

	$args = array(
		'paged'       => $paged,
		'post_status' => 'publish',
	);

	$taxonomy = ! empty( $_POST['taxonomy'] ) ? $_POST['taxonomy'] : '';
	$term_id = ! empty( $_POST['termID'] ) ? $_POST['termID'] : '';

	if ( $taxonomy && $term_id ) {
		$args = array(
			'taxonomy' => $taxonomy,
			'terms'    => $term_id,
		);
	}

	query_posts( $args );

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			echo '<li><a href="' . esc_attr( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li>' . "\r\n";
		}
	}
	wp_die();
}
add_action( 'wp_ajax_loadmore', 'kamuz_loadmore_pagination' );
add_action( 'wp_ajax_nopriv_loadmore', 'kamuz_loadmore_pagination' );
