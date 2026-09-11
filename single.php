<?php
/**
 * Single post template.
 *
 * @package Simple_Theme
 */

get_header();
?>
<div class="container">
	<p>
		&laquo;
		<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>">Back to the Posts</a>
	</p>
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			the_title( '<h1>', '</h1>' );
			the_content();
		}
	}
	?>
</div>
<?php get_footer(); ?>