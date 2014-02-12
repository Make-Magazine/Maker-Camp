<?php
/**
 * Page Template
 *
 * @package    maker-camp
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
get_header(); ?>
		
	<div class="single">
		<div class="container">
			<div class="row">
				<div class="span8">

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
	</div>

<?php get_footer(); ?>