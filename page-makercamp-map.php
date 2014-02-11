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
		<div class="main-content">
			<div class="container map-wrapper">
				<div class="row">
					<?php the_content(); ?>
				</div>
				<div class="row">
					<div class="span6">
						<iframe src="http://mapsengine.google.com/map/u/0/embed?mid=z6jknjwOuQEA.kwp_h1l1fm4s" width="99.5%" height="464"></iframe>
						<table class="table table-striped map-list">
							<thead class="map-list-header">
								<tr>
									<th style="width:110px;">State, City</th>
									<th style="width:20px;">Country</th>
									<th style="width:228px;">Organization</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									if ( ! empty( $addresses ) && is_array( $addresses ) ) :
										foreach ( $addresses as $address ) : ?>
											<tr>
												<td><?php echo esc_attr( $address['Work State, Work City'] ); ?></td>
												<td><?php echo esc_attr( $address['Work Country'] ); ?></td>
												<td><a href="<?php echo esc_url( $address['Website'] ); ?>">
														<?php echo esc_url( $address['Website'] ); ?><?php echo esc_attr( $address['Company'] ); ?>
													</a>
												</td>
												<!-- <td>
													<?php if ( isset( $addressss['Google Link'] ) ) : ?>
														<a href="<?php echo esc_url( $address['google-plus'] ); ?>"><img src="http://makezineblog.files.wordpress.com/2013/06/google-plus.png"></a>
													<?php endif; ?>
												</td> -->
											</tr>
										<?php endforeach;
									endif;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; endif; ?>
<?php get_footer( 'makercamp' ); ?>