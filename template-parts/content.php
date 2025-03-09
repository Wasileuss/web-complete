<div class="blog__item">
  <div class="blog__image">
      <?php if (has_post_thumbnail()) : ?>
          <img
              src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"
              alt="<?php the_title_attribute(); ?>"
          >
      <?php endif; ?>
      <a class="blog__button" href="<?php the_permalink(); ?>">Read Now</a>
  </div>
  <div class="blog__info">
      <h2 class="blog__category">
          <?php 
          $categories = get_the_category();
          if (!empty($categories)) {
              $category = $categories[0];
              $category_link = get_category_link($category->term_id);
              echo '<a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a>';
          }
          ?>
      </h2>
      <div class="blog__description"><?php the_content(); ?></div>
  </div>
</div>
