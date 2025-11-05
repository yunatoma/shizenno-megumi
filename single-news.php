<?php get_header(); ?>

    <main>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="news-detail__container">
        <section id="news-detail">
          <div class="bread_crumbs">
            <?php
            if (function_exists('bcn_display')) {
              bcn_display();
            }
            ?>
          </div>

          <div>
            <h1 class="news-detail__title">
              <?php the_title(); ?>
            </h1>
            <time class="news-detail__time" datetime="<?php echo get_the_date('Y-m-d'); ?>">
              <?php echo get_the_date('Y.m.d'); ?>
            </time>
            <?php
            $terms = get_the_terms(get_the_ID(), 'news_category');
            if ($terms && !is_wp_error($terms)) :
              $term = array_shift($terms);
            ?>
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

              <?php
              // コンテンツからH2とH3の見出しを抽出して目次を生成
              $content = get_the_content();
              $content = apply_filters('the_content', $content);

              // DOMDocumentを使用してHTMLを解析
              $dom = new DOMDocument();
              libxml_use_internal_errors(true);
              // PHP 8.2対応: UTF-8のHTMLとして読み込む
              $dom->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
              libxml_clear_errors();

              $headings = array();
              $xpath = new DOMXPath($dom);
              $h_tags = $xpath->query('//h2 | //h3');

              $index = 1;
              foreach ($h_tags as $heading) {
                $heading_id = 'heading-' . $index;
                $headings[] = array(
                  'id' => $heading_id,
                  'text' => $heading->textContent,
                  'level' => $heading->nodeName
                );
                $index++;
              }
              ?>

              <?php if (!empty($headings)) : ?>
                <div class="news-detail__toc">
                  <h2 class="news-detail__toc-title">目次</h2>
                  <ul class="news-detail__toc-list">
                    <?php foreach ($headings as $heading) : ?>
                      <li class="news-detail__toc-item news-detail__toc-item--<?php echo esc_attr($heading['level']); ?>">
                        <a href="#<?php echo esc_attr($heading['id']); ?>">
                          <?php echo esc_html($heading['text']); ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>

              <div class="news-detail__content">
                <?php
                // コンテンツにIDを追加
                if (!empty($headings)) {
                  $index = 1;
                  $content_with_ids = preg_replace_callback(
                    '/<(h[23])([^>]*)>(.*?)<\/\1>/i',
                    function($matches) use (&$index) {
                      $tag = $matches[1];
                      $attrs = $matches[2];
                      $text = $matches[3];
                      $id = 'heading-' . $index;
                      $index++;

                      // 既存のクラスを保持しつつIDを追加
                      if (strpos($attrs, 'id=') === false) {
                        return '<' . $tag . $attrs . ' id="' . $id . '">' . $text . '</' . $tag . '>';
                      }
                      return $matches[0];
                    },
                    $content
                  );
                  echo $content_with_ids;
                } else {
                  echo $content;
                }
                ?>
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
