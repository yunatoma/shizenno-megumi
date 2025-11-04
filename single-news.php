<?php get_header(); ?>

    <main>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="news-detail__container">
        <section id="news-detail">
          <div class="bread_crumbs">
            ホーム > お知らせ一覧 >
            <?php
            $terms = get_the_terms(get_the_ID(), 'news_category');
            if ($terms && !is_wp_error($terms)) :
              $term = array_shift($terms);
              echo esc_html($term->name);
            endif;
            ?> >
            <?php the_title(); ?>
          </div>

          <div>
            <h1 class="news-detail__title">
              <?php the_title(); ?>
            </h1>
            <time class="news-detail__time" datetime="<?php echo get_the_date('Y-m-d'); ?>">
              <?php echo get_the_date('Y.m.d'); ?>
            </time>
            <?php if ($terms && !is_wp_error($terms)) : ?>
              <div class="news-detail__label"><?php echo esc_html($term->name); ?></div>
            <?php endif; ?>

            <div class="news-detail__wrapper">
              <?php if (has_post_thumbnail()) : ?>
                <img
                  class="news-detail__img"
                  src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>"
                  alt="<?php the_title_attribute(); ?>"
                />
              <?php else : ?>
                <img
                  class="news-detail__img"
                  src="<?php echo get_template_directory_uri(); ?>/assets/img/no-image.svg"
                  alt=""
                />
              <?php endif; ?>

              <div class="news-detail__content">
                <?php the_content(); ?>
              </div>

              <a class="btn-green news-detail__btn" href="<?php echo get_post_type_archive_link('news'); ?>">一覧に戻る</a>
            </div>
          </div>
        </section>
      </div>
      <?php endwhile; endif; ?>

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
    </main>

<?php get_footer(); ?>
