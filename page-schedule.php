<?php
/**
 * Template Name: Maker Camp Schedule
 * Nothing fancy but a template holder... Add all content via the post editor.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Maker Media Web Team: Jake Spurlock, Bill Olson, Cole Geissinger and David Beauchamp <webmaster@makermedia.com>
 *
 */
?>
<?php get_header('makercamp'); ?>
<div class="makercamp-new ">
    <div class="main-header">
      <div class="container">
        <div class="row-fluid" >
          <div class="hidden-desktop text-center">
            <div class="span12">
              <img  style="margin:30px auto" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/mc-logo-2014.gif' ); ?>" />
              <div class="tagline">
                <h1>A <strong>FREE</strong>
                  summer camp for building, tinkering and exploring. Online and in your neighborhood!
                </h1>
                                <h1><strong>July 7th-August 15th, 2014</strong><br />Daily at 11am Pacific Time<h1>

              </div>

            </div>
          </div>
          <div class="visible-desktop">
            <div class="span6">
              <img style="margin:30px auto" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/mc-logo-2014.gif' ); ?>" />
            </div>
            <div class="span6" style="">
              <div class="tagline">
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
  <section class="white-bg">
    <div class="container ">
      <div class="row-fluid">
        <div class="span12">
          <? $year = get_post($post->post_parent)->post_title; ?>
          <h2 style="margin-bottom: 30px; color: red;">Maker Camp Season <?=$year;?></h2>

          <? $terms = get_terms('week', ['hierarchical'  => false]); ?>
          <ul class="nav nav-tabs" role="tablist">
          <? foreach($terms as $term): ?>
            <li class="active"><a href="#home" role="tab" data-toggle="tab">Home</a></li>
            <li><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
            <li><a href="#messages" role="tab" data-toggle="tab">Messages</a></li>
            <li><a href="#settings" role="tab" data-toggle="tab">Settings</a></li>
          <? endforeach; ?>
          </ul>

          <? foreach($terms as $term): ?>
            <div class="week-container" style="margin-bottom: 40px; overflow: auto;">
              <div class="week-image span3 pull-left" style="margin: 0px 30px 0px 0px;"><img src="http://placehold.it/350x350"></div>
              <div class="week-info">
                <h3><?=$term->name?></h3>
                <p class="week-description">
                  <?=$term->description?>
                </p>
              </div>
            </div>
            <div class="clearfix"></div>
            <? // Grab all the terms for this week and year ?>
            <? $args = array('post_type' => 'session', 'post_status' => 'publish', 'week' => $term->name, 'camp' => 'Maker Camp '.$year); ?>
            <?
            $posts = get_posts($args);
            $ordered_posts = [];
            foreach($posts as $my_post) {
              $key = unserialize(get_post_meta($my_post->ID, 'schedule-date', true));
              $ordered_posts[$key][] = $my_post;
            }
            // Sorting this on server -- should be done in SQL but meta-data. :(
            array_multisort($ordered_posts);
            foreach($ordered_posts as $key => $val) {
            ?> <h4 style="background-color: #999; padding: 10px; color: #FFF;"><?=date('l', strtotime( $key ));?></h4> <?
              foreach($val as $p) {
              // Here is where the fun happens for the sessions
              ?>
                <div style="margin-top: 30px; margin-bottom: 30px; overflow: auto;">
                  <div class="span3 pull-left" style="margin-right: 30px; margin-left: 0px"><img src="http://placehold.it/350x350"></div>
                  <div class="session-container" style="overflow: hidden">
                    <h5 class="title"><?=$p->post_title?></h5>
                    <div class="makers">Maker's isn't set-up yet.</div>
                    <p class="session-description" style="margin: 20px 0px 20px 0px;">
                      <?=$p->post_content;?>
                    </p>
                    <? if(unserialize(get_post_meta($p->ID, 'session-link-btn-url', true)) != '') { ?>
                    <a class="btn btn-alert" href="<?=unserialize(get_post_meta($p->ID, 'session-link-btn-url', true));?>"><?=unserialize(get_post_meta($p->ID, 'session-link-btn-title', true));?></a>
                    <? } ?>
                    <div class="advanced-project" style="margin-top: 20px;>
                      <span class="advanced-project-title">Advanced project:</span> <a style="color: red;" href="">hi</a>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>

              <?
              }
            }
            ?>
          <? endforeach; ?>
        </div>
      </div>
    </div>
  </section>
</div>

<?php get_footer( 'makercamp' ); ?>
