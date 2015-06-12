<?php
/**
 * Template Name: Affiliate
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
            <li><a href="/sign-up-for-camp">Sign Up</a></li> 
            <li><a href="/map">Find a Camp</a></li>
            <li><a class="active-hover" href="/affiliate-program">Host a Camp</a></li>
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


          <?php the_content(); ?>


      <div class="row">
        <div class="col-xs-12 text-center padbottom">
          <h1>Host a Camp</h1>
          <h4 class="padbottom">We are currently accepting applications from organizations interested in hosting a physical "campsite" for the 2015 season.</h4>
          <a class="btn-cyan" href="https://docs.google.com/a/makermedia.com/forms/d/15RlD9GtqEWd03wEKDqOuiIOroO6Amvw3sFBwQn3ilCg/viewform">Apply now for the 2015 Maker Camp Affiliate Program</a>
        </div>

        <div class="col-sm-6 padbottom">
          <h2 style="margin-bottom: 15px;">Discover our wide range of kid-friendly, hands-on projects and videos</h2>
          <ul class="stars">
            <li>Find project ideas listed by week on <a style="color: #0088cc;" href="http://makercamp.com/">makercamp.com</a>.</li>
            <li>Incorporate Maker Camp videos (over 90!) into your programs. See YouTube playlists for Maker Camp <a style="color: #0088cc;" href="https://www.youtube.com/playlist?list=PLwhkA66li5vD027TQQWc3qLtU9LtEtCdZ">2013</a> and <a style="color: #0088cc;" href="https://www.youtube.com/playlist?list=PLwhkA66li5vAR_CboA0lVOlrmqIqvlw_O">2014</a>.</li>
            <li>For inspiration, see the projects posted in the <a style="color: #0088cc;" href="https://plus.google.com/communities/107377046073638428310">Maker Camp community</a>. Feel free to post your latest creations!</li>
            <li>Find more project ideas in the <a style="color: #0088cc;" href="http://makercamp.com/wp-content/uploads/2014/06/MakerCamp-Playbook-2014-smaller.pdf">Maker Camp Affiliate Playbook</a>.</li>
          </ul>

        </div>
        <div class="col-sm-6 padbottom">
          <h2 class="padbottom">Create a Maker Camp program just right for you</h2>
          <p>Create your own Maker Camp program:</p>
          <ul class="stars padbottom">
            <li>Integrate the Maker Camp projects, guest makers and virtual field trips into your existing summer program for kids.</li>
            <li>Promote your Maker Camp program and affiliate status with a link on the Maker Camp map.</li>
            <li>Let kids in your neighborhood know you are a Maker Camp affiliate.</li>
            <li>Have the kids share them on the Maker Camp Google+ page.</li>
          </ul>
          <a class="btn-cyan" href="https://docs.google.com/a/makermedia.com/forms/d/15RlD9GtqEWd03wEKDqOuiIOroO6Amvw3sFBwQn3ilCg/viewform">Host a Camp</a>
        </div>
      </div>


    </div>
  </section>
</div>
<?php get_footer(); ?>