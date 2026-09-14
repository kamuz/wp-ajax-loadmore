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
				<?php
				while ( have_posts() ) : the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
			</ul>
			<?php get_template_part( 'partials/loadmore' ); ?>
			<div class="pagination">
				<?php simple_pagination(); ?>
			</div>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>
