<?php

function home_carousel_function($atts) {
  extract(shortcode_atts(array(
      'year' => '2014'
   ), $atts));

  $rs = '<div class="container"><div class="row-fluid">';
  $rs .= '<h2>Upcoming Maker Camp Sessions</h2>';
  $rs .= '<ul>';

  $posts = get_posts(array('post_type' => 'session', 'camp' => 'maker-camp-'.$year));
  $ordered = array();
  foreach($posts as $p) {
    $key = unserialize(get_post_meta($p->ID, 'schedule-date', true));
    $ordered[strtotime($key)][] = $p;
  }
  ksort($ordered);
  foreach($ordered as $o) {
    foreach($o as $s) {
      $rs .= '<li style="float: left; width: 200px; font-size: 11pt; padding: 10px;">';
      $rs .= '<div class="session-title">'.$s->post_title.'</div>';
      $rs .= '<div class="session-image">';
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $s->ID ), 'single-post-thumbnail' );
      $rs .= '<img width="200px" src="'.$image[0].'">';
      $rs .= '</div>';
      $rs .= '<div class="session-content">';
      $rs .= $s->post_content;
      $rs .= '</div>';
    }
  }
  error_log(print_r($rs, true));

  $rs .= '</ul>';
  $rs .= '</div>';
  $rs .= '</div>';
  return $rs;
}

function register_shortcodes(){
  add_shortcode('home-carousel', 'home_carousel_function');
}

add_action( 'init', 'register_shortcodes');