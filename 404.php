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
          <a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">Basecamp</a> 
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
<div class="makercamp-new ">
    <div class="main-header">
        <div class="container">
          <div class="row header-inner">
              <div class="col-sm-4 col-sm-offset-0 col-xs-6 col-xs-offset-3">
                  <img class="img-responsive" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logo-no-makey.jpg' ); ?>" />
              </div>
              <div class="col-xs-12 col-sm-6 col-sm-offset-2">
                <div class="text-center">
                  <h1>July 6th-August 14th, 2015</h1>
                </div>

                <div class="padbottom">
                  <h4>A FREE summer camp from Make: for building, tinkering and exploring. Participate online from home or find a camp host in your neighborhood!</h4>
                </div>
            </div>
          </div>
        </div>
    </div>
  <section class="white-bg padbottom">
    <div class="container padbottom">
      <div class="row">
        <div class="col-sm-12 padbottom text-center">

			<h1 class="404">Oh Nooo! A 404 Page!</h1>

            <p>Looks like we can't find the page that you are looking for. Sorry about that.</p>

        </div>
      </div>
    </div>
  </section>
</div>
<?php get_footer(); ?>
