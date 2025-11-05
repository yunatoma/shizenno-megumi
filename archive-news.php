
<?php get_header(); ?>

    <main>
      <div class="news-list__container">
        <section id="news-list">
          <div class="bread_crumbs">
            <?php
            if (function_exists('bcn_display')) {
              bcn_display();
            }
            ?>
          </div>
          <h1 class="title">お知らせ一覧</h1>
          <ul class="news-list__category-list">
            <li>
              <a href="<?php echo get_post_type_archive_link('news'); ?>">
                <button class="news-list__category-item news-list__category-item--active">
                  すべて
                </button>
              </a>
            </li>
            <?php
            $categories = get_terms(array(
              'taxonomy' => 'news_category',
              'hide_empty' => false,
            ));
            if ($categories && !is_wp_error($categories)) :
              foreach ($categories as $category) :
            ?>
              <li>
                <a href="<?php echo get_term_link($category); ?>">
                  <button class="news-list__category-item">
                    <?php echo esc_html($category->name); ?>
                  </button>
                </a>
              </li>
            <?php
              endforeach;
            endif;
            ?>
          </ul>
          <div class="news-list__wrapper">
            <ul class="news-list__list pc-only">
              <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                  <li class="news-list__item">
                    <a href="<?php the_permalink(); ?>">
                      <?php if (has_post_thumbnail()) : ?>
                        <img
                          class="news-list__img"
                          src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"
                          alt="<?php the_title_attribute(); ?>"
                        />
                      <?php else : ?>
                        <img
                          class="news-list__img"
                          src="<?php echo get_template_directory_uri(); ?>/assets/img/no-image.svg"
                          alt=""
                        />
                      <?php endif; ?>
                      <div class="news-list__text">
                        <time class="news-list__time" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                          <?php echo get_the_date('Y.m.d'); ?>
                        </time>
                        <?php
                        $terms = get_the_terms(get_the_ID(), 'news_category');
                        if ($terms && !is_wp_error($terms)) :
                          $term = array_shift($terms);
                        ?>
                          <div class="news-list__label"><?php echo esc_html($term->name); ?></div>
                        <?php endif; ?>
                        <h2 class="news-list__title">
                          <?php the_title(); ?>
                        </h2>
                        <p class="news-list__body">
                          <?php echo get_the_excerpt(); ?>
                        </p>
                      </div>
                    </a>
                  </li>
                <?php endwhile; ?>
              <?php else : ?>
                <li>お知らせはまだありません。</li>
              <?php endif; ?>
            </ul>

            <ul class="sp-only">
              <?php if (have_posts()) : ?>
                <?php rewind_posts(); // ループを最初から再開 ?>
                <?php while (have_posts()) : the_post(); ?>
                  <li class="news-list__item--sp">
                    <a href="<?php the_permalink(); ?>">
                      <?php
                      $terms = get_the_terms(get_the_ID(), 'news_category');
                      if ($terms && !is_wp_error($terms)) :
                        $term = array_shift($terms);
                      ?>
                        <div class="news-list__label news-list__label--sp">
                          <?php echo esc_html($term->name); ?>
                        </div>
                      <?php endif; ?>
                      <div class="news-list__text--sp">
                        <time class="news-list__time--sp" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                          <?php echo get_the_date('Y.m.d'); ?>
                        </time>
                        <h2 class="news-list__title--sp">
                          <?php the_title(); ?>
                        </h2>
                      </div>
                    </a>
                  </li>
                <?php endwhile; ?>
              <?php else : ?>
                <li>お知らせはまだありません。</li>
              <?php endif; ?>
            </ul>

            <?php get_template_part('template-parts/pagination'); ?>
          </div>
        </section>

        <section id="top-contact">
          <div class="top-contact__wrapper">
            <h2 class="top-contact__title">お問い合わせ</h2>
            <p class="top-contact__caption">
              お仕事のご相談、農園体験、牧場の<br
                class="sp-only"
              />見学、その他ご質問<br />
              お気軽にお問い合わせください。
            </p>
            <a class="btn-green top-contact__btn" href="<?php echo home_url('/contact/'); ?>">お問い合わせ</a>
            <p class="top-contact__phone">
              問い合わせ電話：<br class="sp-only" /><span>123-4567-8910</span>
            </p>
            <p class="top-contact__opening-hours">
              【受付時間】<br class="sp-only" />10:00~18:00(土日祝を除く)
            </p>
          </div>
        </section>
      </div>
    </main>

<?php get_footer(); ?>