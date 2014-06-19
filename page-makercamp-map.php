<?php
/**
 * Template Name: Maker Camp Map
 * Nothing fancy but a template holder... Add all content via the post editor.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Cole Geissinger <cgeissinger@makermedia.com>
 *
 */
?>

<?php get_header( 'makercamp' ); ?>
	<?php
		$get_addresses = get_post_meta( get_the_ID(), 'makercamp-maps-data', false );
		$addresses = json_decode( str_replace( '&quot;', '"', $get_addresses[0] ), true );
	?>
	<script>
		jQuery(document).ready(function( $ ) {
			$( '.map-list' ).tablesorter();
		});
	</script>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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
	<section class="white-bg intro map-page">
		<div class="container ">

			<div class="row-fluid">

				<div class="span12">

							<?php the_content(); ?>

				</div>
			</div>
			<div class="row">
				<div class="span12">
					<table class="table table-striped map-list">
						<thead class="map-list-header">
							<tr>
								<th style="width:55px;">Country</th>
								<th style="width:75px;">State</th>
								<th style="width:140px;">City</th>
								<th style="width:228px;">Organization</th>
								<th style="width:81px;">Website</th>
								<th style="width:25px;">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if ( ! empty( $addresses ) && is_array( $addresses ) ) :
									foreach ( $addresses as $address ) : ?>
										<tr>
											<td><?php echo esc_attr( $address['Work Country'] ); ?></td>
											<td><?php echo esc_attr( $address['Work State'] ); ?></td>
											<td><?php echo esc_attr( $address['Work City'] ); ?></td>
											<td><?php echo esc_attr( $address['Company'] ); ?></td>
											<td><a href="<?php echo esc_url( $address['Website'] ); ?>"><?php echo esc_url( $address['Website'] ); ?></a></td>
											<td>
												<?php if ( isset( $addressss['Google Link'] ) ) : ?>
													<a href="<?php echo esc_url( $address['google-plus'] ); ?>"><img src="http://makezineblog.files.wordpress.com/2013/06/google-plus.png"></a>
												<?php endif; ?>
											</td>
										</tr>
									<?php endforeach;
								endif;
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	<?php endwhile; endif; ?>

<?php get_footer( 'makercamp' ); ?>
