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
<div class="makercamp-new camp">
  <div class="main-header">
    <div class="container">
      <div class="row-fluid" >
        <div class="hidden-desktop text-center">
          <div class="span12">
            <img  class="logo" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/mc-logo-2014.gif' ); ?>" />
            <div class="tagline">
              <h1>A <strong>FREE</strong> summer camp for building, tinkering and exploring. Online and in your neighborhood!</h1>
              <h1><strong>July 7th-August 15th, 2014</strong><br />Daily at 11am Pacific Time<h1>
            </div>
          </div>
        </div>
        <div class="visible-desktop">
          <div class="span6">
            <img  class="logo" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/mc-logo-2014.gif' ); ?>" />
          </div>
          <div class="span6" style="">
            <div class="tagline">
              <h1>A <strong>FREE</strong> summer camp for building, tinkering and exploring. Online and in your neighborhood!</h1>
              <h1><strong>July 7th-August 15th, 2014</strong><br />Daily at 11am Pacific Time<h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="white-bg schedule-content ">
    <div class="container ">
      <div class="row-fluid tab-navigation">
        <div class="span12">
          <? $year = get_post($post->post_parent)->post_title; ?>
          <h2>Maker Camp Season <?=$year;?></h2>
          <? $terms = get_terms('week', array('hierarchical'  => false, 'hide_empty' => 0)); ?>

          <ul class="nav nav-tabs" id="schedule" role="tablist">
            <? $i=0;?>
            <? foreach($terms as $term): ?>
              <? if($i==0) { ?>
              <li class="active"><a href="#<?=$term->slug;?>" role="tab" data-toggle="tab"><?=$term->name;?></a></li>
              <? $i++; } else { ?>
              <li><a href="#<?=$term->slug;?>" role="tab" data-toggle="tab"><?=$term->name;?></a></li>
              <? } ?>
            <? endforeach; ?>
          </ul>

          <div class="tab-content">
          <? $i = 0; ?>
          <? foreach($terms as $term): ?>
            <? if($i == 0) { ?>
              <div class="tab-pane active" id="<?=$term->slug;?>">
            <? $i++; } else { ?>
              <div class="tab-pane" id="<?=$term->slug;?>">
            <? } ?>
                <div class="week-container">
                  <?php $image_src = s8_get_taxonomy_image_src($term, 'medium'); ?>
                  <? if($image_src != null): ?>
                    <div class="week-image span3 pull-left"><img src="<?=$image_src['src'];?>"></div>
                  <? endif; ?>
                  <div class="week-info">
                    <h3><?=$term->name?></h3>
                    <p class="week-description">
                      <?=$term->description?>
                    </p>
                    <p>
                      <h4>Jump to a day:</h4>
                      <br>
                      <?$week = $term->slug."-"; ?>
                      <ul>
                        <li><a href="#<?=$week;?>day-1">Day One</a></li>
                        <li><a href="#<?=$week;?>day-2">Day Two</a></li>
                        <li><a href="#<?=$week;?>day-3">Day Three</a></li>
                        <li><a href="#<?=$week;?>day-4">Day Four</a></li>
                        <li><a href="#<?=$week;?>day-5">Day Five</a></li>
                      </ul>
                    </p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <? // Grab all the terms for this week and year ?>
                <? $args = array('posts_per_page'   => -1, 'post_type' => 'session', 'post_status' => 'publish', 'week' => $term->name, 'camp' => 'Maker Camp '.$year); ?>
                <?
                $posts = get_posts($args);
                $ordered_posts = array();
                foreach($posts as $my_post) {
                  $key = unserialize(get_post_meta($my_post->ID, 'schedule-date', true));
                  $ordered_posts[date('w', strtotime($key))][] = $my_post;
                }
                #error_log(print_r($ordered_posts, true));
                ksort($ordered_posts);
                // Sorting this on server -- should be done in SQL but meta-data. :(
                #array_multisort($ordered_posts, SORT_DESC);
                $dow = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                foreach($ordered_posts as $key => $val) {
                   // WEEKDAY heading
                ?> <!--h4 style="background-color: #999; padding: 10px; color: #FFF;">Day <?=date('w', strtotime($key));?>: <?=date('l', strtotime( $key ));?></h4--> <?
                ?> <h4 class="schedule-day" id="<?=$week;?>day-<?=$key;?>">Day <?=$key;?>: <?=$dow[$key];?></h4> <?
                  foreach($val as $p) {
                  // Here is where the fun happens for the sessions
                  ?>
                    <div class="session-area">
                      <? $image = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), 'single-post-thumbnail' ); ?>
                      <div class="session-image span3 pull-left"><img src="<?=$image[0]; ?>"></div>
                      <div class="session-container">
                        <h5 class="title"><?=$p->post_title?></h5>
                        <?
                          $post_makers = unserialize(get_post_meta(absint($p->ID), 'session-makers', true));
                          $my_makers = array();
                          $post_makers_list = make_maker_get_list();
                          if(count($post_makers_list) > 0 && is_array($post_makers)) {
                            foreach($post_makers_list as $pml) {
                              if(in_array($pml->ID, $post_makers)) {
                                $modal .= create_maker_modal($pml);
                                $my_makers[] = '<a href="#" data-toggle="modal" data-target="#'.$pml->post_name.'">'.$pml->post_title.'</a>';
                              }
                            }
                          }
                        ?>
                        <div class="makers">
                        <? if(count($my_makers) > 0) { ?>
                          MAKERS:
                          <?=join(", ", $my_makers);?>
                        <? } ?>
                        </div>
                        <p class="session-description">
                          <?=$p->post_content;?>
                        </p>
                        <? if(unserialize(get_post_meta($p->ID, 'session-link-btn-url', true)) != '') { ?>
                          <a class="btn btn-danger" href="<?=unserialize(get_post_meta($p->ID, 'session-link-btn-url', true));?>" target="_blank"><?=unserialize(get_post_meta($p->ID, 'session-link-btn-title', true));?></a>
                        <? } ?>

                        <? $daily = unserialize(get_post_meta($p->ID, 'session-daily-project', true)); ?>
                        <? if(is_array($daily) && $daily['url'] != '') { ?>
                          <div class="project-item">
                            <span class="project-item-title">Daily project:</span>
                            <a href="<?=$daily['url'];?>" target="_blank">
                              <?=$daily['title']?>
                            </a>
                          </div>
                        <? }; ?>

                        <? $sap = unserialize(get_post_meta($p->ID, 'session-adv-project', true)); ?>
                        <? if(is_array($sap) && $sap['url'] != ''): ?>
                          <div class="project-item">
                            <span class="project-item-title">Advanced project:</span>
                            <a href="<?=$sap['url'];?>" target="_blank">
                              <?=$sap['title']?>
                            </a>
                          </div>
                        <? endif; ?>

                        <? $skill = unserialize(get_post_meta($p->ID, 'session-skill-project', true)); ?>
                        <? if(is_array($skill) && $skill['url'] != '') { ?>
                          <div class="project-item">
                            <span class="project-item-title">Skill builder project:</span>
                            <a href="<?=$skill['url'];?>" target="_blank">
                              <?=$skill['title']?>
                            </a>
                          </div>
                        <? }; ?>

                        <? $weekend = unserialize(get_post_meta($p->ID, 'session-weekend-project', true)); ?>
                        <? if(is_array($weekend) && $weekend['url'] != '') { ?>
                          <div class="project-item">
                            <span class="project-item-title">Weekend project:</span>
                            <a href="<?=$weekend['url'];?>" target="_blank">
                              <?=$weekend['title']?>
                            </a>
                          </div>
                        <? }; ?>

                      </div>
                    </div>
                    <div class="clearfix"></div>
                  <?
                  }
                }
                ?>
              </div><!-- /tab-pane -->
          <? endforeach; ?>
          </div><!-- /tab-content -->
        </div>
      </div>
    <div class="row-fluid">
      <div class="span12 past-camps">
        <h3>Past Camps</h3>
        <ul>
          <li><a href="http://makercamp.com/summer-2013/schedule/">Maker Camp 2013</a></li>
          <li><a href="http://makercamp.com/summer-2012/schedule/">Maker Camp 2012</a></li>
        </ul>
      </div>
      </div>
    </div>
  </section>

<?=$modal;?>
<style>
  /* Adding this because without it, the modals seem to overlay dom elements when not in use. */
  .modal {
    display: none;
  }
</style>
</div>
<?php get_footer( 'makercamp' ); ?>
