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
	<div
		id="loadmore" style="text-align:center;"><a href=""
		data-maxpages="<?php echo esc_attr( $max_pages ); ?>"
		data-paged="<?php echo esc_attr( $current_page ); ?>"
		data-taxonomy="<?php echo is_category() ? 'category' : esc_attr( get_query_var( 'taxonomy' ) ); ?>"
		data-term-id="<?php echo esc_attr( get_queried_object_id() ); ?>"
		data-pagenumlink="<?php echo esc_url( get_pagenum_link() ); ?>"
		class="button">Load more</a></div>
<?php endif; ?>