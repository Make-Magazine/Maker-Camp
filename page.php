<?php
/**
 * Page Template
 *
 * @package    maker-camp
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 *
 */
get_header(); ?>
<div class="makercamp-new ">
		<div class="main-header">
			<div class="container">
				<div class="row-fluid" >
					<div class="hidden-desktop text-center">
						<div class="span12">
							<img  style="margin:30px auto" src="https://makezineblog.files.wordpress.com/2014/06/maker-camp-logo-2014-e1402943555658.png?w=564" />
							<div class="tagline" style="margin-top:25px;">
								<h1>A <strong>FREE</strong>
									summer camp for building, tinkering and exploring. Online and in your neighborhood!
								</h1>
																<h1><strong>July 7th-August 15th, 2014</strong><br />Daily at 11am Pacific Time<h1>

							</div>

						</div>
					</div>
					<div class="visible-desktop">
						<div class="span6">
							<img style="margin:30px auto" src="https://makezineblog.files.wordpress.com/2014/06/maker-camp-logo-2014-e1402943555658.png?w=564" />
						</div>
						<div class="span6" style="">
							<div class="tagline" style="margin-top:25px;">
								<h1>A <strong>FREE</strong>
									summer camp for building, tinkering and exploring. Online and in your neighborhood!
								</h1>
																<h1><strong>July 7th-August 15th, 2014</strong><br />Daily at 11am Pacific Time<h1>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	<section class="white-bg intro">
		<div class="container ">
			<div class="row-fluid">
				<div class="span12">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<article <?php post_class(); ?>>

							<?php the_content(); ?>

						</article>

					<?php endwhile; else: ?>

						<p><?php _e( 'Sorry, no page found.', 'makercamp' ); ?></p>

					<?php endif; ?>

				</div>
			</div>
		</div>
	</section>
</div>
<?php get_footer(); ?>
