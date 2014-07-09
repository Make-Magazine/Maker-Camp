<?php

function home_carousel_function($atts) {
  extract(shortcode_atts(array(
      'year' => '2014'
   ), $atts));

  $rs = '<div class="container"><div class="row-fluid">';
  $rs .= '<h2 style="margin-bottom: 20px;">Upcoming Maker Camp Sessions</h2>';
  $rs .= '<ul class="carousel" style="overflow: auto; margin: 0px; padding: 0px;">';

  $posts = get_posts(array('post_type' => 'session', 'camp' => 'maker-camp-'.$year, 'posts_per_page' => -1));
  error_log("Post count: " . count($posts));
  #print_r($posts);

  // Let's figure out what our posts date blocks look like...
  $posts_start = NULL;
  $posts_finish = NULL;
  foreach($posts as $p) {
    $my_date = strtotime(unserialize(get_post_meta($p->ID, 'schedule-date', true)));

    if($posts_start == NULL) {
      $posts_start = $my_date;
    }
    if($posts_end == NULL) {
      $posts_finish = $my_date;
    }
    if($my_date < $posts_start) {
      $posts_start = $my_date;
    }
    if($my_date > $posts_finish) {
      $posts_finish = $my_date;
    }
  }

  error_log("Posts Start: " . $posts_start);
  error_log("Posts Finish: " . $posts_finish);

  // Now let's figure out what week we're going to display...
  $now = strtotime("now");
  if($now < $posts_start) {
    error_log("It's coming up.");
    // display the first week
    $start_of_week = strtotime('last sunday', $posts_start);
    $end_of_week = strtotime('+1 week', $start_of_week);
  } elseif($now > $posts_start && $now < $posts_finish) {
    error_log("We're in it.");
    // we're now in a session, display appropriate week
    $start_of_week = strtotime('last sunday', $now);
    $end_of_week = strtotime('+1 week', $start_of_week);
  } elseif($now > $posts_finish) {
    error_log("It's gone.");
    // guessing we display the last week here.
    $start_of_week = strtotime('last sunday', $posts_finish);
    $end_of_week = strtotime('+1 week', $start_of_week);
  }

  error_log("Start of week: " . $start_of_week);
  error_log("End of week: " . $end_of_week);

  // now let's filter out our posts
  $i = 0;
  $ordered = array();
  foreach($posts as $p) {
    $key = unserialize(get_post_meta($p->ID, 'schedule-date', true));
    $post_time = strtotime($key);

    // get current week results for display
    error_log("Post Time: ". $post_time);
    if($post_time < $end_of_week && $post_time > $start_of_week) {
      $ordered[$post_time] = $p;
    } else {
      error_log("Post-id: ". $p->ID . " didn't make it with Post time: " .$post_time);
      error_log("Title: " . $p->post_title);
    }
  }

  // sort posts by date
  ksort($ordered);
  $menu_items = wp_get_nav_menu_items('maker-camp-nav');
  $schedule_url = $menu_items[1]->url;

  foreach($ordered as $s) {
    $week = wp_get_post_terms($s->ID, 'week');
    $week_slug = $week[0]->slug;
    #foreach($o as $s) {
      $rs .= '<li style="float: left; width: 200px; font-size: 13pt; padding: 10px; color: #000;">';
      $rs .= '<div class="session-image" style="margin-bottom: 10px;">';
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $s->ID ), 'single-post-thumbnail' );
      $rs .= '<a href="'.$schedule_url.'#'.$week_slug.'">';
      $rs .= '<img width="200px" src="'.$image[0].'">';
      $rs .= '</a>';
      $rs .= '</div>';
      $rs .= '<div class="session-title"><a href="'.$schedule_url.'#'.$week_slug.'">'.$s->post_title.'</a></div>';
      #$rs .= '<div class="session-content">';
      #$rs .= $s->post_content;
      #$rs .= '</div>';
    #}
  }
  #error_log(print_r($rs, true));

  $rs .= '</ul>';
  $rs .= '</div>';
  $rs .= '</div>';
  return $rs;
}

function register_shortcodes(){
  add_shortcode('home-carousel', 'home_carousel_function');
}

add_action( 'init', 'register_shortcodes');