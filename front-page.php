<?php get_header(); ?>

    <main>
      <section class="hero">
        <div class="hero__inner">
          <div class="hero__logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/LOGO2.svg" alt="自然の恵み農園のロゴ" />
          </div>
          <h1 class="hero__title">
            自然の恵みを感じ、<br class="sp-only" />豊かな未来を。
          </h1>
        </div>
        <article class="hero__news">
          <?php
          $latest_news = new WP_Query(array(
            'post_type' => 'news',
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC'
          ));
          if ($latest_news->have_posts()) :
            while ($latest_news->have_posts()) : $latest_news->the_post();
          ?>
            <a href="<?php the_permalink(); ?>" class="hero__news-link">
              <div class="hero__news-header">
                <span class="hero__news-label">News</span>
                <time class="hero__news-date" datetime="<?php echo get_the_date('Y-m-d'); ?>"
                  ><?php echo get_the_date('Y.m.d'); ?></time
                >
              </div>
              <p class="hero__news-text">
                <?php the_title(); ?>
              </p>
            </a>
          <?php
            endwhile;
            wp_reset_postdata();
          else :
          ?>
            <a href="<?php echo get_post_type_archive_link('news'); ?>" class="hero__news-link">
              <div class="hero__news-header">
                <span class="hero__news-label">News</span>
                <time class="hero__news-date" datetime="">-</time>
              </div>
              <p class="hero__news-text">
                お知らせはまだありません。
              </p>
            </a>
          <?php endif; ?>
        </article>
        <a
          href="#about"
          class="hero__scroll"
          aria-label="次のセクションへスクロール"
        >
          <span class="hero__scroll-text">scroll</span>
        </a>
      </section>

      <section id="about">
        <div class="about__wrapper">
          <div class="about__img">
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/img/about1.png"
              width="200"
              height="252"
              alt="山羊の写真"
            />
          </div>
          <div class="about__img">
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/img/about2.png"
              width="181"
              height="217"
              alt="トマトの写真"
            />
          </div>
          <div class="about__img">
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/img/about3.png"
              width="200"
              height="200"
              alt="農家さんの写真"
            />
          </div>
          <div class="about__img">
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/img/about4.png"
              width="235"
              height="269"
              alt="牛の写真"
            />
          </div>

          <h2 class="about__heading">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="" />
          </h2>

          <div>
            <p class="about__text">
              自然の恵み農園は、
              <br />自然の恵みと動物の尊さが調和する<br
                class="sp-only"
              />特別な場所です。<br />
              新鮮で美味しい農産物を栽培し、<br
                class="sp-only"
              />心温まる動物たちと触れ合える場所<br
                class="sp-only"
              />でもあります。
            </p>

            <p class="about__text">
              自然の恵みを受け、<br
                class="sp-only"
              />動物たちとの特別なひとときを<br
                class="sp-only"
              />楽しんでいただける場所として、<br />
              私たちは誇りを持って活動をしています。<br />
              一緒に自然と動物の美しさを共有しましょう。
            </p>
          </div>
        </div>
      </section>

      <section id="intro">
        <div class="intro__inner">
          <h2 class="title intro__title">活動紹介</h2>
          <div class="intro__btn-list" role="tablist">
            <button
              class="intro__btn is-active"
              type="button"
              data-tab="farm"
              role="tab"
              aria-selected="true"
            >
              農園
            </button>
            <button
              class="intro__btn"
              type="button"
              data-tab="ranch"
              role="tab"
              aria-selected="false"
            >
              牧場
            </button>
            <button
              class="intro__btn"
              type="button"
              data-tab="online"
              role="tab"
              aria-selected="false"
            >
              オンライン販売
            </button>
          </div>
          <div class="intro__content">
            <div class="content show" data-tab="farm">
              <p class="intro__text">
                私たちは、「持続可能な農業」を掲げて、自然の恵みに感謝しながら、農作物を育てています。<br
                  class="sp-only"
                />無農薬で、体にも環境にも優しく、季節ごとに異なる品種を育て、提供しています。ぜひ一度、農園にお越し頂き、自分の手で収穫した新鮮な野菜・果物をお召し上がりください。
              </p>
            </div>
            <div class="content" data-tab="ranch" hidden>
              <p class="intro__text">
                牧場では、広々とした自然の中で牛やヤギがのびのび暮らし、毎日ていねいに健康管理を行っています。<br
                  class="sp-only"
                />見学では搾乳体験や餌やり体験もでき、命の鼓動を間近に感じられます。動物たちとの温かな時間を通して、命の尊さを一緒に学びましょう。
              </p>
            </div>
            <div class="content" data-tab="online" hidden>
              <p class="intro__text">
                オンライン販売では、採れたての農産物や牧場で育まれた加工品を、そのまま全国へお届けしています。<br
                  class="sp-only"
                />旬のセットや季節限定商品もご用意し、ご自宅に居ながら自然の恵みを味わえるよう工夫しています。ご家庭の食卓で、自然の豊かさをお楽しみください。
              </p>
            </div>
          </div>
        </div>

        <div class="autoplay intro__img-list content show" data-tab="farm">
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/activity_farm1.png" alt="" />
          </div>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/activity_farm2.png" alt="" />
          </div>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/activity_farm3.png" alt="" />
          </div>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/activity_farm4.png" alt="" />
          </div>
        </div>

        <div class="autoplay intro__img-list content" data-tab="ranch" hidden>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/activity_lanch1.png" alt="" />
          </div>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/activity_lanch2.png" alt="" />
          </div>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/activity_lanch3.png" alt="" />
          </div>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/activity_lanch4.png" alt="" />
          </div>
        </div>

        <div class="autoplay intro__img-list content" data-tab="online" hidden>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/activity_online1.png" alt="" />
          </div>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/activity_online2.png" alt="" />
          </div>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/activity_online3.png" alt="" />
          </div>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/activity_online4.png" alt="" />
          </div>
        </div>
      </section>

      <section id="faq">
        <h2 class="title faq__title">よくあるご質問</h2>

        <div class="faq__accordion">
          <details>
            <summary>農園の野菜や果物は有機栽培ですか？</summary>
            <div class="faq__answer">
              <p>
                はい、私たちの農園では有機栽培の原則に従って野菜と果物を栽培しています。<br />
                化学肥料や農薬を極力使用せず、土壌と作物の健康を第一に考えております。
              </p>
            </div>
          </details>
          <details>
            <summary>農園での見学や体験ツアーは行っていますか？</summary>
            <div class="faq__answer">
              <p>
                はい、農園での見学や体験ツアーを随時開催しています。<br />
                農場の日常や農作業を親しみやすく説明し、実際に農園での体験を楽しむことができます。
              </p>
            </div>
          </details>
          <details>
            <summary>
              オンラインで注文した農産物はどのように配送されますか？
            </summary>
            <div class="faq__answer">
              <p>
                オンラインで注文いただいた農産物は、専用の梱包で新鮮さを保ったまま、<br />
                指定された配送先にお届けします。
              </p>
            </div>
          </details>
          <details>
            <summary>
              農園で提供される季節ごとの野菜や果物の品種は何ですか？
            </summary>
            <div class="faq__answer">
              <p>
                春にはイチゴ、夏にはトマトや茄子、秋にはカボチャやリンゴ、冬にはブロッコリーやみかん<br />
                など、季節に応じた野菜、果物を提供、収穫体験することができます。
              </p>
            </div>
          </details>
        </div>
      </section>

      <section id="top-news">
        <div class="top-news__left">
          <h2 class="title top-news__title">お知らせ</h2>
          <p class="top-news__description">
            季節の農作物のお知らせ、見学ツアーのご案内、<br class="pc-only" />
            オンライン販売セールのお知らせなど、自然の恵み農園の最新情報をお届けします。
          </p>

          <a class="pc-only btn-green top-news__btn" href="<?php echo esc_url(home_url('/news/')); ?>">View More</a>
        </div>

        <article class="top-news__right">
          <ul class="top-news__list">
            <?php
            $news_query = new WP_Query(array(
              'post_type' => 'news',
              'posts_per_page' => 3,
              'orderby' => 'date',
              'order' => 'DESC'
            ));
            if ($news_query->have_posts()) :
              while ($news_query->have_posts()) : $news_query->the_post();
            ?>
              <li class="top-news__item">
                <a href="<?php the_permalink(); ?>">
                  <time class="top-news__time" datetime="<?php echo get_the_date('Y-m-d'); ?>"
                    ><?php echo get_the_date('Y.m.d'); ?></time
                  >
                  <?php
                  $terms = get_the_terms(get_the_ID(), 'news_category');
                  if ($terms && !is_wp_error($terms)) :
                    $term = array_shift($terms);
                  ?>
                    <div class="top-news__category"><?php echo esc_html($term->name); ?></div>
                  <?php endif; ?>
                  <h3 class="top-news__article-title">
                    <?php the_title(); ?>
                  </h3>
                </a>
              </li>
            <?php
              endwhile;
              wp_reset_postdata();
            else :
            ?>
              <li class="top-news__item">お知らせはまだありません。</li>
            <?php endif; ?>
          </ul>
        </article>

        <a class="sp-only btn-green" href="<?php echo esc_url(home_url('/news/')); ?>">View More</a>
      </section>

      <section id="access">
        <h2 class="access__title title">アクセス</h2>
        <div class="access__content">
          <div class="access__left">
            <dt>会社名</dt>
            <dt>所在地</dt>
            <dt>電話番号</dt>
            <dt>営業時間</dt>
            <dt>Googleマップ</dt>
            <dt>拡大地図を表示</dt>
          </div>
          <div class="access__right-top">
            <dd>株式会社自然の恵み農園</dd>
            <dd>
              〒123-4567 <br class="sp-only" />千葉県〇〇市××町<br
                class="sp-only"
              />1丁目23-45
            </dd>
            <dd>012-3456-7890</dd>
            <dd>10:00〜18:00<br class="sp-only" />（土日祝を除く）</dd>
          </div>
          <div class="access__right-bottom">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3237.60720914243!2d140.0615382!3d35.760458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60227e5329d23245%3A0xd4cde63c28d3f984!2z44G144Gq44Gw44GX44Ki44Oz44OH44Or44K744Oz5YWs5ZyS!5e0!3m2!1sja!2sjp!4v1761376067227!5m2!1sja!2sjp"
              height="300"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
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
    </main>

<?php get_footer(); ?>
