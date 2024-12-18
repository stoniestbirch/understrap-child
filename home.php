<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>



<div class="wrapper" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

		<div class="col-md content-area" id="primary">

			<main class="site-main" id="main">

			<div class="wrapper" id="wrapper-static-hero">

				<div class="<?php echo esc_attr( $container ); ?>" id="wrapper-static-content" tabindex="-1">

					<div class="row">

					<?php
						// Fetch the latest post from the 'editorial' category
						$latest_posts = get_posts([
						'category_name' => 'editorial', // Category slug
						'numberposts' => 6,            // Get only the latest post
						'orderby' => 'date',           // Order by date
						'order' => 'DESC'              // Descending order (latest first)
						]);
					
						if (!empty($latest_posts)) {
						$post = $latest_posts[0];
						setup_postdata($post);
						?>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php the_excerpt(); ?></p>
						<p><small>Published on: <?php echo get_the_date(); ?></small></p>
						<?php
						wp_reset_postdata(); // Reset post data after processing
						}
					?>

					</div>

				</div>

			</div><!-- #wrapper-static-hero -->
						<div class="row">
			<div class="col-md-4 widget-area d-none d-lg-block" id="left-sidebar">
				<h3>More editorials</h3>
				<?php 
				// Display the next 5 posts
				for ($i = 1; $i < count($latest_posts); $i++) {
					$post = $latest_posts[$i];
					setup_postdata($post);
					?>
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					
					<p><small>Published on: <?php echo get_the_date(); ?></small></p>
					<?php
				}
				wp_reset_postdata(); // Reset post data after processing all posts

				?>
				<p><a href="">More editorials &gt;&gt;</a></p>
			</div><!-- #left-sidebar -->
			<div class="col" id="main-content">	
						
				<?php
				if ( have_posts() ) {
					// Start the Loop.
					$i = 0;
					while ( have_posts() ) {
						$i++;
						the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						if ($i < 10){
						get_template_part( 'loop-templates/content', get_post_format() );
						} else {
							?>
							<div>
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							</div>
							<?php
						}
					}
				} else {
					get_template_part( 'loop-templates/content', 'none' );
				}
				?>
				
			</div><!-- #main-content -->
			</div>
			</main>

			<?php
			

			//set theme modification to display right sidebar md-3
			set_theme_mod( 'understrap_sidebar_position', 'both' );
			// Do the right sidebar check and close div#primary.
			get_template_part( 'global-templates/right-sidebar-check' );
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
