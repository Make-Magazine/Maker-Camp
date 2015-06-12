<?php
/**
 * Template Name: Sign Up
 *
 * @package    maker-camp
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
            <li><a class="active-hover" href="/sign-up-for-camp">Sign Up</a></li> 
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
        <div class="col-sm-12 text-center padbottom">
          <h1>Sign Up now for our 2015 Camp alerts!</h1>
          <h4>Until camp starts, please check out our <a href="https://plus.google.com/u/0/communities/107377046073638428310" target="_blank">Maker Camp community site.</a></h4>
        </div>
        <div class="col-sm-4">
          <h2 class="dark-bue padtop">Sign Up!</h2>
          <p class="dark-blue padbottom">Maker Camp Starts right here on makercamp.com on July 6. Sign up to get updates and fun alerts!</p>
          <div>
            <form action="http://whatcounts.com/bin/listctrl" method="POST">
              <input type="hidden" name="slid" value="6B5869DC547D3D4658DF84D7F99DCB43" />
              <input type="hidden" name="cmd" value="subscribe" />
              <input type="hidden" name="custom_source" value="Sign up page" /> 
              <input type="hidden" name="custom_incentive" value="none" /> 
              <input type="hidden" name="custom_url" value="makercamp.com/sign-up-for-camp" />
              <input type="hidden" id="format_mime" name="format" value="mime" />
              <input type="hidden" name="goto" value="" />
              <input type="hidden" name="custom_host" value="Makercamp" />
              <input type="hidden" name="errors_to" value="" />
              <div>
                <input name="name" placeholder="Enter your Name" type="text"><br>
                <input name="email" placeholder="Enter your Email" required="required" type="text"><br>
                <input value="SIGN UP FOR CAMP ALERTS" class="btn-cyan" type="submit" style="width:100%;">
              </div>
              </form>
          </div>
        </div>
        <div class="col-sm-6 col-sm-offset-2 padtop">
          <span class="embed-youtube" style="text-align:center; display: block;">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/MakerStudioMakeyMakeyGuitar.jpg' ); ?>" class="img-responsive" />
          </span>
        </div>
      </div>
    </div>
  </section>
</div>
<?php get_footer(); ?>
