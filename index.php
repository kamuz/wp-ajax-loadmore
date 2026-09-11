<?php
/**
 * Index template
 *
 * @package simple-theme
 */

get_header(); ?>
	<div class="container">
		<h1 class="title"><?php bloginfo( 'name' ); ?></h1>
		<?php if ( have_posts() ) : ?>
			<ul id="posts-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>
			<div class="pagination">
				<?php
				global $wp_query;
				echo paginate_links(
					array(
						'total'   => $wp_query->max_num_pages,
						'current' => max( 1, get_query_var( 'paged' ) ),
						'type'    => 'list',
					)
				);
				?>
			</div>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>
