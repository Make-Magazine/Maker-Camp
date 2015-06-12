<?php
	/*
	  Template Name: Home Page Template
	 * @package    maker-camp
	 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
	 * @author     Maker Media Web Team: Jake Spurlock, Bill Olson, Cole Geissinger and David Beauchamp <webmaster@makermedia.com>
	 *
	 */
	get_header(); ?>
				    <a class="navbar-brand active-hover" href="<?php echo esc_url( home_url() ); ?>">Basecamp</a> 
				  </div> 
				  <!-- Collect the nav links, forms, and other content for toggling --> 
				  <div class="pull-right collapse navbar-collapse navbar-ex1-collapse"> 
				    <ul class="nav navbar-nav"> 
				      <li><a href="/sign-up-for-camp">Sign Up</a></li> 
				      <li><a href="/map">Find a Camp</a></li>
				      <li><a href="/affiliate-program">Host a Camp</a></li>
				      <li><a href="https://plus.google.com/communities/107377046073638428310" target="_blank">Community</a></li>
				      <li><a href="https://help.makercamp.com/hc/en-us" target="_blank">Help</a></li>
				    </ul>
				  </div>
			</div>
		</nav>		
	</header>
	<div class="makercamp makercamp-new">
			<div class="main-header-container">
				<div class="main-header">
					<div class="container">
						<div class="row header-inner">
				            <div class="col-sm-4 col-sm-offset-0 col-xs-6 col-xs-offset-3">
				                <img class="img-responsive" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logo-no-makey.jpg' ); ?>" />
				            </div>
							<div class="col-xs-12 col-sm-6 col-sm-offset-2">
									<div class="tagline text-center">
										<h1>July 6th-August 14th, 2015</h1>
									</div>

									<div class="row padtop padbottom">
										<div class="col-sm-6 text-center padbottom">
											<a class="btn-red" href="/sign-up-for-camp/">KIDS: SIGN UP!</a>
											<p><small>Maker Camp is free!</small></p>
										</div>
										<div class="col-sm-6 text-center">
											<a class="btn-cyan" href="/affiliate-program/">HOST A CAMP</a>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
				<div class="home-page-nav">
					<div class="container text-center">
						<ul class="nav nav-pills">
							<li><a href="#welcome">Welcome</a></li>
							<li><a href="#howitworks">How It Works</a></li>
							<li><a href="#2015theme">2015 Themes</a></li>
							<li><a href="#affiliatecamps">Physical Campsites</a></li>
							<li><a href="#dayatcamp">A Day at Camp</a></li>
						</ul>
					</div>
				</div>
			</div>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<article <?php post_class( 'home-page' ); ?>>

					<section class="white-bg intro rocket-bg padtop padbottom">
						<div class="container">
							<div class="row">
								<a class="scrolls" id="welcome"></a>
								<div class="col-sm-12 text-center padbottom">
									<h1>Welcome to Maker Camp!</h1>
									<h4>Maker Camp is a free online summer camp for kids ages 8 to 12, and Makers of all ages!</h4>
								</div>
								<div class="col-sm-4">
									<p>Join young inventors and artists from around the world too. We make awesome projects, go on epic virtual “field trips,” and meet the world’s coolest makers.</p>
									<p class="padbottom"><strong>Sign up to be a Maker Camp Affiliate site</strong>. You’ll inspire kids to embrace their inner maker, get their hands dirty, fix some things, break some things, and have a lot of fun doing it.</p>
									<h2 class="dark-bue padtop">Sign Up!</h2>
									<p class="dark-blue padbottom">Maker Camp Starts right here on makercamp.com on July 6. Sign up to get updates and fun alerts!</p>
									<div>
										<form action="http://whatcounts.com/bin/listctrl" method="POST">
											<input type="hidden" name="slid" value="6B5869DC547D3D4658DF84D7F99DCB43" />
											<input type="hidden" name="cmd" value="subscribe" />
											<input type="hidden" name="custom_source" value="Home Page" /> 
											<input type="hidden" name="custom_incentive" value="none" /> 
											<input type="hidden" name="custom_url" value="Makercamp" />
											<input type="hidden" id="format_mime" name="format" value="mime" />
											<input type="hidden" name="goto" value="" />
											<input type="hidden" name="custom_host" value="makercamp.com" />
											<input type="hidden" name="errors_to" value="" />
											<div>
												<input name="name" placeholder="Enter your Name" type="text"><br>
												<input name="email" placeholder="Enter your Email" required="required" type="text"><br>
												<input value="SIGN UP FOR CAMP ALERTS" class="btn-cyan" type="submit" style="width:100%;">
											</div>
									    </form>
									</div>
								</div>
								<div class="col-sm-6 col-sm-offset-2">
									<span class="embed-youtube" style="text-align:center; display: block;">
										<iframe class="youtube-player" type="text/html" src="https://www.youtube.com/embed/lxxgvv__pUo" frameborder="0" allowfullscreen="true"></iframe>
									</span>
								</div>
							</div>
						</div>
					</section>

					<section class="dark-blue-bg padtop padbottom">
						<div class="container">
							<div class="row">
								<a class="scrolls" id="howitworks"></a>
								<div class="col-sm-12 text-center padbottom">
									<h1>How Maker Camp Works</h1>
									<h4>Maker Camp is a free, online summer camp you can join anytime!</h4>
								</div>
								<div class="col-sm-6 padright padleft text-center">
									<img src="/wp-content/themes/Maker-Camp/img/Kids_2.png" class="img-circle padbottom" />
									<h4 class="padtop text-light-blue">Join a hosted Camp in your neighborhood</h4>
									<p class="padtop padbottom">Our affiliates offer physical campsites where you will work with other kids and adults to guide you. Affiliates can be Boys &amp; Girls Clubs, community centers and many more!</p>
									<div class="row">	
										<div class="col-md-10 col-md-offset-2 padbottom">
											<div class="row">
												<div class="col-xs-1">
													<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span>
												</div>
												<div class="col-xs-11 icon-a-tag">
													<a class="pull-left" href="/map"><strong>Find a campsite in your neightborhood</strong></a>
												</div>
											</div>
										</div>
										<div class="col-md-10 col-md-offset-2 padbottom">
											<div class="row">
												<div class="col-xs-1">
													<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span>
												</div>
												<div class="col-xs-11 icon-a-tag">
													<a class="pull-left" href="/affiliate-program"><strong>Host a Camp</strong></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6 padright padleft text-center">
									<img src="/wp-content/themes/Maker-Camp/img/Kids_1.png" class="img-circle padbottom" />
									<h4 class="padtop text-light-blue">Participate online from home</h4>
									<p class="padtop padbottom">Join us at Makercamp.com to explore a new project every day. Videos give you an overview about the project. We give you links to projects you can work out at home.</p>
									<div class="row">	
										<div class="col-md-10 col-md-offset-2 padbottom">
											<div class="row">
												<div class="col-xs-1">
													<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span>
												</div>
												<div class="col-xs-11 icon-a-tag">
													<a class="pull-left" href="/sign-up-for-camp"><strong>Sign up for fun alerts</strong></a>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</section>

					<section class="white-bg intro padtop padbottom">
						<div class="container">
							<div class="row">
								<a class="scrolls" id="2015theme"></a>
								<div class="col-sm-12 text-center padbottom">
									<h1>2015 Maker Camp Themes</h1>
									<h4>6 weeks of hands-on projects &amp; cool field trips!</h4>
								</div>
								<div class="col-sm-6">
									<div class="row padbottom">
										<div class="col-sm-3">
											<img src="/wp-content/themes/Maker-Camp/img/Week_1.png" class="img-responsive img-circle padright" />
										</div>
										<div class="col-sm-9">
											<h2>Week 1: Fantasy</h2>
											<p><strong>(July 6–10)</strong> Make:believe with the magic behind the movies, ending with a Maker Camp Film Fest.</p>
										</div>
									</div>
									<div class="row padbottom">
										<div class="col-sm-3">
											<img src="/wp-content/themes/Maker-Camp/img/Week_2.png" class="img-responsive img-circle padright" />
										</div>
										<div class="col-sm-9">
											<h2>Week 2: Funkytown</h2>
											<p><strong>(July 13–17)</strong> Make some instruments, then make some noise in the Maker Camp Battle of the Bands.</p>
										</div>
									</div>
									<div class="row padbottom">
										<div class="col-sm-3">
											<img src="/wp-content/themes/Maker-Camp/img/Week_3.png" class="img-responsive img-circle padright" />
										</div>
										<div class="col-sm-9">
											<h2>Week 3: Farmstead</h2>
											<p><strong>(July 20–24)</strong> Hack the Hoedown with sustainable energy, food, architecture, and craft that bridge across centuries.</p>
										</div>
									</div>
								</div>

								<div class="col-sm-6">
									<div class="row padbottom">
										<div class="col-sm-3">
											<img src="/wp-content/themes/Maker-Camp/img/Week_4.png" class="img-responsive img-circle padright" />
										</div>
										<div class="col-sm-9">
											<h2>Week 4: Fun &amp; Games</h2>
											<p><strong>(July 27–31)</strong> Roll out the fun with games you make yourself, then challenge your friends with a Maker Camp Carnival.</p>
										</div>
									</div>
									<div class="row padbottom">
										<div class="col-sm-3">
											<img src="/wp-content/themes/Maker-Camp/img/Week_5.png" class="img-responsive img-circle padright" />
										</div>
										<div class="col-sm-9">
											<h2>Week 5: Flight</h2>
											<p><strong>(August 3–7)</strong> Take off in this make-off of all things that zip and zoom above our heads, culminating in the Maker Camp Air Show.</p>
										</div>
									</div>
									<div class="row padbottom">
										<div class="col-sm-3">
											<img src="/wp-content/themes/Maker-Camp/img/Week_6.png" class="img-responsive img-circle padright" />
										</div>
										<div class="col-sm-9">
											<h2>Week 6: Far-Out Future</h2>
											<p><strong>(August 10–14)</strong> Step into the future with personal fab projects using new materials, and strut your shiny stuff in a Far-Out Fashion Show.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>

					<section class="bg-green padtop padbottom">
						<div class="container padbottom">
							<div class="row">
								<a class="scrolls" id="affiliatecamps"></a>
								<div class="col-sm-12 text-center padbottom">
									<h1>Physical Campsites</h1>
								</div>
								<div class="col-sm-5">
									<p>Maker Camp is an online summer camp that happens everywhere around the world</p>
									<p>But you can meet your neighbors who are taking part in the Maker Camp too!</p>
									<p class="padtop padbottom">Many libraries, makerspaces, and community centers are hosting Maker Camp for kids in their communittires!</p>
									<div class="row padbottom">
										<div class="col-xs-1">
											<!-- <img src="http://lorempixel.com/50/50/" class="img-circle" /> -->
											<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span>
										</div>
										<div class="col-xs-11 icon-a-tag">
											<a href="/map"><strong>Find out if there's one close to you and join the fun</strong></a>
										</div>
									</div>
									<div class="row padbottom">
										<div class="col-xs-1">
											<!--img src="http://lorempixel.com/50/50/" class="img-circle" /-->
											<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span>
										</div>
										<div class="col-xs-11 icon-a-tag">
											<a href="/affiliate-program"><strong>Host a Camp</strong></a>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-sm-offset-1">
							        <a href="/map"><img class="img-responsive" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/maker-camp-map.jpg' ); ?>" /></a>
								</div>
							</div>
						</div>
					</section>

					<section class="white-bg intro padtop padbottom">
						<div class="container">
							<div class="row">
								<a class="scrolls" id="dayatcamp"></a>
								<div class="col-sm-12 text-center padbottom">
									<h1 class="dark-green">A Day at Camp</h1>
								</div>
								<div class="col-sm-4 padbottom padtop text-center">
									<h3><strong>Explore</strong></h3>
									<p>Get your feet wet as you get inspired by what Makers do and play around with the stuff, tools, and ways of making.</p>
								</div>
								<div class="col-sm-4 padbottom padtop text-center">
									<h3><strong>Make</strong></h3>
									<p>Our cool and fun step-by-step projects branch out from the theme. Advanced Makers can take on our Camp Challenges.</p>
								</div>
								<div class="col-sm-4 padbottom padtop text-center">
									<h3><strong>Share</strong></h3>
									<p>Share what you’ve done online. Meet up in real life with our end-of-week showcases. Or connect cabin-to-cabin with other Maker Campers.</p>
								</div>
							</div>
						</div>
					</section>

					<section class="white-bg intro home-ground intro">
					</section>

					<div class="clear"></div>
					<script>
						jQuery(document).ready(function(){
							jQuery('a[href^="#"]').on('click',function (e) {
							    e.preventDefault();

							    var target = this.hash;
							    var jQuerytarget = jQuery(target);

							    jQuery('html, body').stop().animate({
							        'scrollTop': jQuerytarget.offset().top
							    }, 900, 'swing', function () {
							        window.location.hash = target;
							    });
							});
						});
					</script>

				</article>

			<?php endwhile; ?>


			<?php else: ?>

				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

			<?php endif; ?>

<?php get_footer(); ?>
