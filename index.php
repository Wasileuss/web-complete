<?php get_header(); ?>
  <div class="page__blog blog">
    <div class="blog__container">
    <?php get_template_part('template-parts/header', 'blog'); ?>
      <div class="blog__content" id="posts-container">
        <?php
          $args = [
              'post_type'      => 'post',
              'posts_per_page' => 3,
              'orderby'        => 'date',
              'order'          => 'ASC'
          ];
          
          $query = new WP_Query($args);
          
          if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
          ?>
          <?php get_template_part('template-parts/content', 'post'); ?>
          <?php endwhile; ?>
          <?php endif; wp_reset_postdata(); ?>
      </div>
      <button class="blog__button-more" id="load-more" data-category="<?php echo esc_attr(get_queried_object_id()); ?>" type="button">LOAD MORE Posts</button>
    </div>
  </div>
<?php get_footer(); ?>