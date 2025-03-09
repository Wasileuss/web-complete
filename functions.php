<?php

define('WC_DIR_CSS', get_template_directory_uri() . '/assets/css/');
define('WC_DIR_JS', get_template_directory_uri() . '/assets/js/');

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('main', WC_DIR_CSS . 'main.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('load-more', WC_DIR_JS . 'load-more.js', ['jquery'], '1.0.0', true);
    wp_localize_script('load-more', 'load_more_params', [
      'ajax_url' => admin_url('admin-ajax.php'),
      'nonce'    => wp_create_nonce('load_more_nonce')
  ]);
});

add_action('after_setup_theme', function() {
    add_theme_support('post-thumbnails');
});

function load_more_posts() {
  if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'load_more_nonce')) {
      die('Permission Denied');
  }

  $paged = isset($_POST['page']) ? $_POST['page'] : 1;
  $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';

  $args = [
      'post_type'      => 'post',
      'posts_per_page' => 3,
      'paged'          => $paged,
      'orderby'        => 'date',
      'order'          => 'ASC'
  ];

  if (!empty($category_id)) {
      $args['cat'] = $category_id;
  }

  $query = new WP_Query($args);

  if ($query->have_posts()) :
      $posts = '';
      while ($query->have_posts()) : $query->the_post();
          ob_start();
          get_template_part('template-parts/content', 'post');
          $posts .= ob_get_clean();
      endwhile;

      $has_more_posts = $query->max_num_pages > $paged ? true : false;

      echo json_encode([
          'has_more_posts' => $has_more_posts,
          'posts' => $posts
      ]);
  else:
      echo json_encode([
          'has_more_posts' => false,
          'posts' => ''
      ]);
  endif;

  wp_reset_postdata();
  die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');
