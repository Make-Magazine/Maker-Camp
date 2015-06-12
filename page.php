<?php
/**
 * Page Template
 *
 * @package    maker-camp
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Maker Media Web Team: Jake Spurlock, Bill Olson, Cole Geissinger and David Beauchamp <webmaster@makermedia.com>
 *
 */
get_header(); ?>
<div class="makercamp-new ">
    <div class="main-header">
        <div class="container">
          <div class="row padtop">
            <div class="col-md-6">
                <img class="img-responsive" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/logo.png' ); ?>" />
            </div>
            <div class="col-md-6">
                <div class="text-center padtop padbottom">
                  <h1></h1>
                </div>
            </div>
          </div>
        </div>
    </div>
  <section class="white-bg padbottom">
    <div class="container padbottom">
      <div class="row">
        <div class="col-sm-12 padbottom">

          <?php the_content(); ?>

        </div>
      </div>
    </div>
  </section>
</div>
<?php get_footer(); ?>