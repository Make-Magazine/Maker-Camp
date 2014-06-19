<?php
	/*
	  Template Name: Home Page Template
	 * @package    maker-camp
	 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
	 *
	 */
	get_header(); ?>
	<div class="home blog makercamp makercamp-new ">
		<div class="container-fluid">
			<span class="visible-desktop skyships"></span>
			<div class="main-header">
				<div class="container">
					<div class="row-fluid">
						<div class="hidden-desktop text-center">
							<div class="span12">
								<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logo.png' ); ?>" />
								<div class="tagline">
									<h1>A <strong>FREE</strong>
										summer camp from Google and Make for building, tinkering and exploring. Online and in your neighborhood!
									</h1>
									<h1><strong>July 7th-August 15th, 2014</strong><br />Daily at 11am Pacific Time<h1>
								</div>
							</div>
						</div>
						<div class="visible-desktop">
							<div class="span6">
								<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logo.png' ); ?>" />
							</div>
							<div class="span6" style="">
								<div class="tagline">
									<h1>A <strong>FREE</strong>
										summer camp from Google and Make for building, tinkering and exploring. Online and in your neighborhood!
									</h1>
									<h1><strong>July 7th-August 15th, 2014</strong><br />Daily at 11am Pacific Time<h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<article <?php post_class( 'home-page' ); ?>>

					<?php the_content(); ?>

					<div class="clear"></div>

				</article>

			<?php endwhile; ?>


			<?php else: ?>

				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

			<?php endif; ?>

	</div><!--Container-->

<?php get_footer(); ?>




