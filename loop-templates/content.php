<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class('col'); ?> id="post-<?php the_ID(); ?>">

<div class="h-100 p-3 bg-info rounded-1">
	<header class="entry-header">

		<?php
		the_title(
			sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>'
		);
		?>

		

	</header><!-- .entry-header -->

	
<div class="row">
		
		<div class="col-md-4">
		<?php echo get_the_post_thumbnail( $post->ID, 'large', ['class'=> 'img-thumbnail alignright'] ); ?>
		</div>

		<div class="col-md-8">
			<?php if ( 'post' === get_post_type() ) : ?>

				<div class="entry-meta">
					<?php understrap_posted_on(); ?>
				</div><!-- .entry-meta -->

			<?php endif; ?>
			<div class="entry-content">

				<?php
				the_excerpt();
				understrap_link_pages();
				?>

			</div><!-- .entry-content -->
		</div>
</div>

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->
		
			</div>		
</article><!-- #post-<?php the_ID(); ?> -->
