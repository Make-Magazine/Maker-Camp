<?php
/**
 * Template Name: Maker Camp Map
 * Nothing fancy but a template holder... Add all content via the post editor.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Maker Media Web Team: Jake Spurlock, Bill Olson, Cole Geissinger and David Beauchamp <webmaster@makermedia.com>
 *
 */
?>

<?php get_header(); ?>
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
							<img  style="margin:30px auto" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/mc-logo-2014.gif' ); ?>" />
							<div class="tagline" style="margin-top:25px;">
								<h1>A <strong>FREE</strong> summer camp from Make: for building, tinkering and exploring. Participate online from home or find a camp host in your neighborhood! (2015 Camp Hosts coming&nbsp;soon!)</h1>
								<h1><strong>July 6th–August 14th, 2015</strong><h1>
							</div>
						</div>
					</div>
					<div class="visible-desktop">
						<div class="span6">
							<img style="margin:30px auto" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/mc-logo-2014.gif' ); ?>" />
						</div>
						<div class="span6" style="">
							<div class="tagline" style="margin-top:25px;">
								<h1>A <strong>FREE</strong>
									summer camp for building, tinkering and exploring. Online and in your neighborhood!
								</h1>
								<!-- <h1><strong>July 6 - August 15, 2015</strong><h1> -->

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	<section class="white-bg map-page">
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
								<th style="width:50px;">State</th>
								<th style="width:140px;">City</th>
								<th style="width:258px;">Organization</th>
								<th style="width:81px;">Accepting</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if ( ! empty( $addresses ) && is_array( $addresses ) ) :
									foreach ( $addresses as $address ) : ?>
										<tr>
											<td><?php echo esc_attr( $address['Country'] ); ?></td>
											<td><?php echo esc_attr( $address['State'] ); ?></td>
											<td><?php echo esc_attr( $address['City'] ); ?></td>
											<td><a href="<?php echo esc_url( $address['Website'] ); ?>"><?php echo esc_attr( $address['Company'] ); ?></a></td>
											<td><?php echo esc_attr( $address['Accepting'] ); ?></td>

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

<?php get_footer(); ?>
