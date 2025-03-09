<?php get_header(); ?>
  <div class="page__blog blog">
    <div class="blog__container">
    <div class="blog__header">
        <h1 class="blog__title">The Journal</h1>
        <a class="blog__link" href="#" onclick="if(document.referrer) { window.history.back(); } else { window.location.href='<?php echo home_url(); ?>'; }">
          Back to previous page
        </a>
      </div>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="blog__item-single post">
        <div class="post__image">
          <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" >
        </div>
        <div class="post__info">
          <h2 class="post__category"><?php the_title(); ?></h2>
          <div class="post__description">
            <p><?php the_content(); ?></p>
          </div>
        </div>
      </div>
      <?php endwhile; endif; ?>
      <?php wp_reset_query(); ?>
    </div>
  </div>
<?php get_footer(); ?>
