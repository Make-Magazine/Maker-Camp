<?php
/**
 * 404 Page
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Maker Media Web Team: Jake Spurlock, Bill Olson, Cole Geissinger and David Beauchamp <webmaster@makermedia.com>
 *
 */
get_header(); ?>
<div class="makercamp-new page-404">
		<div class="main-header">
			<div class="container">
				<div class="row-fluid" >
					<div class="hidden-desktop text-center">
						<div class="span12">
							<img  style="margin:30px auto" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logo-no-makey.jpg' ); ?>" />
							<div class="tagline" style="margin-top:25px;">
								<h1>A <strong>FREE</strong> summer camp from Make: for building, tinkering and exploring. Participate online from home or find a camp host in your neighborhood! (2015 Camp Hosts coming&nbsp;soon!)</h1>
								<h1><strong>July 6th–August 14th, 2015</strong><h1>
							</div>

						</div>
					</div>
					<div class="visible-desktop">
						<div class="span6">
							<img style="margin:30px auto" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logo-no-makey.jpg' ); ?>" />
						</div>
						<div class="span6" style="">
							<div class="tagline" style="margin-top:25px;">

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	<section class="white-bg">
		<div class="container ">
			<div class="row-fluid">
				<div class="span12">

					<h1 class="404">Oh Nooo! A 404 Page!</h1>

                                <p>Looks like we can't find the page that you are looking for. Sorry about that.</p>

                                <!-- <p>Let's see if we can make it up to you. First off, let's try searching for the content. You can do that in the search form below.</p>

                                <form action="<?php echo home_url(); ?>" class="search-make open">
                                    <div class="input-append">
                                        <input type="text" class="search-field" name="s">
                                        <button type="submit" class="btn btn-primary" value="Search"><i class="icon icon-search icon-white"></i> Search</button>
                                    </div>
                                </form>

                                <p>If that doesn't work, why not try browsing from popular categories?</p>

                                <ul class="columns">
                                    <?php wp_list_categories( 'title_li=' ); ?>
                                </ul> -->

				</div>
			</div>
		</div>
	</section>
</div>
<?php get_footer(); ?>
