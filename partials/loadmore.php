<?php
/**
 * Load More
 *
 * @package simple-theme
 */

global $wp_query;
$current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$max_pages    = $wp_query->max_num_pages;
?>

<?php if ( $current_page < $max_pages ) : ?>
	<div id="loadmore" style="text-align:center;"><a href="#" data-paged="<?php echo esc_attr( $current_page ); ?>" class="button">Load more</a></div>
<?php endif; ?>