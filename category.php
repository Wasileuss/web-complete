<?php get_header(); ?>
  <div class="page__blog blog">
    <div class="blog__container">
      <?php get_template_part('template-parts/header', 'blog'); ?>
      <?php 
      $category = get_queried_object();
      $posts_per_page = 3;

      $args = [
          'post_type'      => 'post',
          'posts_per_page' => $posts_per_page,
          'cat'            => $category->term_id,
          'orderby'        => 'date',
          'order'          => 'DESC'
      ];

      $query = new WP_Query($args);

      if ($query->have_posts()) : ?>
          <div class="blog__content">
              <?php while ($query->have_posts()) : $query->the_post(); ?>
                  <?php get_template_part('template-parts/content', 'post'); ?>
              <?php endwhile; ?>
          </div>

          <?php 
          $total_posts = $query->found_posts;
          if ($total_posts > $posts_per_page) : ?>
              <button class="blog__button-more" id="load-more" data-category="<?php echo esc_attr(get_queried_object_id()); ?>" type="button">
                  LOAD MORE Posts
              </button>
          <?php endif; ?>

      <?php else : ?>
          <p>There are no entries in this category yet.</p>
      <?php endif; ?>

      <?php wp_reset_postdata(); ?>
    </div>
  </div>
<?php get_footer(); ?>


                  