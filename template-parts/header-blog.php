<div class="blog__header">
    <h1 class="blog__title"><?php echo get_bloginfo('name'); ?></h1>
    <ul class="blog__category-list category-list">
        <li class="category-list__item">
            <a
              class="category-list__link <?php echo (is_category() && !is_home()) ? '' : 'category-list__link--active'; ?>"
              href="<?php echo esc_url(home_url('/')); ?>"
            >
              All
            </a>
        </li>

        <?php 
        $categories = get_categories([
            'hide_empty' => false,
            'exclude'    => [1]
        ]);

        usort($categories, function($a, $b) {
            return $a->term_id - $b->term_id;
        });

        foreach ($categories as $category) :
            $category_link = get_category_link($category->term_id);

            $active_class = is_category($category->term_id) ? 'category-list__link--active' : '';
        ?>
            <li class="category-list__item <?php echo esc_attr($active_class); ?>">
                <a class="category-list__link" href="<?php echo esc_url($category_link); ?>">
                    <?php echo esc_html($category->name); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
