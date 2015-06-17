<?php
/**
 * Template Name: Maker Camp Map
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Maker Media Web Team: Jake Spurlock, Bill Olson, Cole Geissinger and David Beauchamp <webmaster@makermedia.com>
 *
 */
?>

<?php get_header(); ?>
          <a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">Basecamp</a> 
        </div> 
        <!-- Collect the nav links, forms, and other content for toggling --> 
        <div class="pull-right collapse navbar-collapse navbar-ex1-collapse"> 
          <ul class="nav navbar-nav">
            <li><a href="/sign-up-for-camp">Sign Up</a></li> 
            <li><a class="active-hover" href="/map">Find a Camp</a></li>
            <li><a href="/affiliate-program">Host a Camp</a></li>
            <li><a href="https://plus.google.com/communities/107377046073638428310" target="_blank">Community</a></li>
            <li><a href="https://help.makercamp.com/hc/en-us" target="_blank">Help</a></li>
          </ul>
        </div>
    </div>
  </nav>    
</header>
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
        	<div class="row header-inner">
	            <div class="col-sm-4 col-sm-offset-0 col-xs-6 col-xs-offset-3">
	                <img class="img-responsive" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logo-no-makey.jpg' ); ?>" />
	            </div>
				<div class="col-xs-12 col-sm-6 col-sm-offset-2">
	                <div class="text-center padtop padbottom">
	                  <h1 class="padtop">2015 Campsites</h1>
	                </div>
	            </div>
	        </div>
          </div>
        </div>
    </div>
	<section class="white-bg map-page">
		<div class="container ">
			<div class="row">
				<div class="col-md-12 padtop">

<!-- 					<img class="img-responsive padbottom" style="width:100%;" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/coming-soon-temporary-map-2.jpg' ); ?>" /> -->

			        <div class="google-maps">
			          <iframe src="https://www.google.com/maps/d/embed?mid=znSdL4uF4CiE.k7sHDldZCKys"></iframe>
			        </div>

					<div class="row padtop">
						<div class="col-sm-6 padbottom">
							<h3>Maker Camp 2015 will launch July 6th</h3> 
							<h4 class="text-red padbottom">To find out if a Maker Camp affiliate site near you is currently running making programs or will rejoin in July, check their website, or send an email inquiry.</h4>
							
							<p class="padbottom">Maker Camp is an online summer camp that happens everywhere around the world. But you can meet your neighbors who are taking part in Maker Camp too! Many libraries, makerspaces, and community centers are hosting Maker Camps for the kids in their communities!</p>
							<p class="padbottom">Find out if there’s one close to you and join the fun.</p>
							<ul class="stars">
								<li>Search by map pins or on the list below.</li>
								<li>Visit the affiliate's website to check the hours they’re hosting Maker Camp.</li>
								<li>Bring your maker friends, too!</li>
							</ul>
						</div>
						<div class="col-sm-6 padbottom">
							<h3>Add a Maker Camp near you</h3>
							<p class="padbottom">If you can't find a nearby site in the list or the map, talk to your local library, makerspace, Boys &amp; Girls Club, or community center about <a href="/affiliate-program">hosting Maker Camp</a> for the kids in your community.</p>
							<p class="padbottom">Maker Camp Affiliate Sites often get a package of materials for making and for promoting the camp.</p>
							<p class="padbottom">Whether or not you are able to find an organization to host Maker Camp, you can still be a part of Maker Camp no matter where you are!</p>
						</div>
					</div>
				</div>
			</div>
 			<div class="row padtop">
				<div class="col-xs-12 padbottom">
					<h3>Find a Camp</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
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
